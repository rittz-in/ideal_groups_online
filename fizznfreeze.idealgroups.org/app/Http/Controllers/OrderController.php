<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use App\Models\Table;
use App\Services\UpiPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
  /**
   * Place a new order (Public API - no auth required)
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'table_number' => 'required|string',
      'customer_name' => 'required|string|max:100',
      'customer_mobile' => 'required|string|max:20',
      'items' => 'required|array|min:1',
      'items.*.product_id' => 'required|exists:products,id',
      'items.*.quantity' => 'required|integer|min:1',
      'items.*.special_instructions' => 'nullable|string|max:500',
      'notes' => 'nullable|string|max:1000',
    ]);

    if ($validator->fails()) {
      return response()->json(
        [
          'success' => false,
          'message' => 'Validation failed',
          'errors' => $validator->errors(),
        ],
        422
      );
    }

    try {
      DB::beginTransaction();

      // Find or create table reference
      $table = Table::where('table_number', $request->table_number)->first();

      // Check for existing active order for this table and customer
      $existingOrder = Order::where('table_number', $request->table_number)
        ->where('customer_mobile', $request->customer_mobile)
        ->whereNotIn('status', ['completed', 'cancelled'])
        ->first();

      // Calculate totals for new items
      $additionalSubtotal = 0;
      $orderItems = [];

      foreach ($request->items as $item) {
        $product = Products::findOrFail($item['product_id']);
        $price = $product->discount_price > 0 ? $product->discount_price : $product->price;
        $itemTotal = $price * $item['quantity'];
        $additionalSubtotal += $itemTotal;

        $orderItems[] = [
          'product_id' => $product->id,
          'product_name' => $product->name,
          'price' => $price,
          'quantity' => $item['quantity'],
          'total' => $itemTotal,
          'special_instructions' => $item['special_instructions'] ?? null,
        ];
      }

      if ($existingOrder) {
        // Update existing order
        $existingOrder->subtotal += $additionalSubtotal;
        $existingOrder->total += $additionalSubtotal;

        // Determine next batch suffix
        $lastBatch = $existingOrder
          ->items()
          ->whereNotNull('batch_group')
          ->orderBy('batch_group', 'desc')
          ->first();
        $nextBatch = 'a';
        if ($lastBatch) {
          $nextBatch = ++$lastBatch->batch_group;
        } else {
          // Check if there are items without batch group (first round)
          $hasItems = $existingOrder->items()->count() > 0;
          $nextBatch = $hasItems ? 'b' : 'a';
        }

        // If there are new notes, append them
        if ($request->notes) {
          $existingOrder->notes = $existingOrder->notes
            ? $existingOrder->notes . "\n---\n" . $request->notes
            : $request->notes;
        }

        $existingOrder->save();
        $order = $existingOrder;
        $orderBatch = $nextBatch;
        $message = 'Items added to your existing order successfully!';
      } else {
        // Create new order
        $order = Order::create([
          'order_number' => Order::generateOrderNumber(),
          'table_id' => $table?->id,
          'table_number' => $request->table_number,
          'customer_name' => $request->customer_name,
          'customer_mobile' => $request->customer_mobile,
          'subtotal' => $additionalSubtotal,
          'tax' => 0,
          'discount' => 0,
          'total' => $additionalSubtotal,
          'status' => 'pending',
          'payment_status' => 'unpaid',
          'notes' => $request->notes,
        ]);
        $orderBatch = 'a';
        $message = 'Order placed successfully!';
      }

      // Create order items
      foreach ($orderItems as $item) {
        $item['batch_group'] = $orderBatch;
        $item['status'] = 'pending';
        $order->items()->create($item);
      }

      // Store customer info in session for persistence
      session([
        'customer_name' => $request->customer_name,
        'customer_mobile' => $request->customer_mobile,
      ]);

      DB::commit();

      return response()->json([
        'success' => true,
        'message' => $message,
        'order' => [
          'id' => $order->id,
          'order_number' => $order->order_number,
          'table_number' => $order->table_number,
          'total' => $order->total,
          'status' => $order->status,
          'items_count' => $order->items()->count(),
        ],
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(
        [
          'success' => false,
          'message' => 'Failed to place order: ' . $e->getMessage(),
        ],
        500
      );
    }
  }




  /**
   * Get order status by order number (Public API)
   */
  public function status($orderNumber)
  {
    $order = Order::with('items')->where('order_number', $orderNumber)->first();

    if (!$order) {
      return response()->json(
        [
          'success' => false,
          'message' => 'Order not found',
        ],
        404
      );
    }

    // Check if order can be cancelled (within 2 minutes and still pending)
    $minutesSinceOrder = $order->created_at->diffInMinutes(now());
    $canCancel = $order->status === 'pending' && $minutesSinceOrder < 2;
    $cancelTimeRemaining = max(0, 2 - $minutesSinceOrder);

    return response()->json([
      'success' => true,
      'order' => [
        'order_number'        => $order->order_number,
        'customer_name'       => $order->customer_name,
        'table_number'        => $order->table_number,
        'status'              => $order->status,
        'payment_status'      => $order->payment_status,
        'total'               => $order->total,
        'created_at'          => $order->created_at->format('d M Y h:i A'),
        'confirmed_at'        => $order->confirmed_at ? $order->confirmed_at->format('h:i A') : null,
        'prepared_at'         => $order->prepared_at  ? $order->prepared_at->format('h:i A')  : null,
        'served_at'           => $order->served_at    ? $order->served_at->format('h:i A')    : null,
        'completed_at'        => $order->completed_at ? $order->completed_at->format('h:i A') : null,
        'can_cancel'          => $canCancel,
        'cancel_time_remaining' => $cancelTimeRemaining,
        'items'               => $order->items->where('status', '!=', 'cancelled')->map(function ($item) {
          return [
            'name'     => $item->product_name,
            'quantity' => $item->quantity,
            'price'    => $item->price,
            'total'    => $item->total,
          ];
        })->values(),
      ],
    ]);
  }

  /**
   * Cancel order (only within 2 minutes of placing)
   */
  public function cancel($orderNumber)
  {
    $order = Order::where('order_number', $orderNumber)->first();

    if (!$order) {
      return response()->json(
        [
          'success' => false,
          'message' => 'Order not found',
        ],
        404
      );
    }

    // Check if order can be cancelled
    $minutesSinceOrder = $order->created_at->diffInMinutes(now());

    if ($order->status !== 'pending') {
      $statusMsg = $order->status === 'confirmed' ? 'confirmed and is being prepared' : $order->status;
      return response()->json(
        [
          'success' => false,
          'message' => "Order cannot be cancelled. It has already been {$statusMsg}.",
        ],
        400
      );
    }

    if ($minutesSinceOrder >= 2) {
      return response()->json(
        [
          'success' => false,
          'message' => 'Cancellation window has expired. Orders can only be cancelled within 2 minutes of placing.',
        ],
        400
      );
    }

    // Cancel the order
    $order->status = 'cancelled';
    $order->save();

    return response()->json([
      'success' => true,
      'message' => 'Order cancelled successfully',
    ]);
  }

  /**
   * Get orders by mobile number (Public API)
   */
  public function myOrders($mobile)
  {
    $orders = Order::where('customer_mobile', $mobile)
      ->orderBy('created_at', 'desc')
      ->limit(10)
      ->get()
      ->map(function ($order) {
        $minutesSinceOrder = $order->created_at->diffInMinutes(now());
        return [
          'order_number' => $order->order_number,
          'table_number' => $order->table_number,
          'total' => $order->total,
          'status' => $order->status,
          'payment_status' => $order->payment_status,
          'created_at' => $order->created_at->format('d M Y h:i A'),
          'can_cancel' => $order->status === 'pending' && $minutesSinceOrder < 2,
        ];
      });

    return response()->json([
      'success' => true,
      'orders' => $orders,
    ]);
  }

  /**
   * Show checkout page
   */
  public function checkout($table = null)
  {
    $customerInfo = [
      'name' => session('customer_name', ''),
      'mobile' => session('customer_mobile', ''),
      'notes' => '',
      'existing_order' => null,
    ];

    // Store table number in session to track active table
    if ($table) {
      session(['active_table' => $table]);
      $activeOrder = Order::where('table_number', $table)
        ->whereIn('status', ['pending', 'confirmed'])
        ->whereNotIn('payment_status', ['paid', 'pending_verification'])
        ->when($customerInfo['mobile'], function ($q) use ($customerInfo) {
          return $q->where('customer_mobile', $customerInfo['mobile']);
        })
        ->orderBy('created_at', 'desc')
        ->first();

      if ($activeOrder) {
        $customerInfo['name'] = $activeOrder->customer_name;
        $customerInfo['mobile'] = $activeOrder->customer_mobile;
        $customerInfo['notes'] = $activeOrder->notes;
        $customerInfo['existing_order'] = [
          'order_number' => $activeOrder->order_number,
          'items_count' => $activeOrder->items()->count(),
        ];
      }
    }

    return view('frontend.pages.checkout', compact('table', 'customerInfo'));
  }

  /**
   * Show order confirmation page
   */
  public function confirmation($orderNumber)
  {
    $order = Order::where('order_number', $orderNumber)
      ->with('items')
      ->first();

    if (!$order) {
      return redirect()
        ->route('homee')
        ->with('error', 'Order not found');
    }

    return view('frontend.pages.order_confirmation', compact('order'));
  }

  /**
   * Show track order page
   */
  public function trackOrder(Request $request)
  {
    $orderNumber = $request->query('order');
    $tableNumber  = $request->query('table');
    return view('frontend.pages.track_order', compact('orderNumber', 'tableNumber'));
  }

  /**
   * Get the latest active order for a table (Public API)
   */
  public function tableActiveOrder($tableNumber)
  {
    $order = Order::where('table_number', $tableNumber)
      ->whereNotIn('status', ['completed', 'cancelled'])
      ->orderBy('created_at', 'desc')
      ->first();

    if (!$order) {
      return response()->json(['success' => false, 'message' => 'No active order for this table.'], 404);
    }

    return response()->json([
      'success'      => true,
      'order_number' => $order->order_number,
      'status'       => $order->status,
      'customer_name' => $order->customer_name,
      'total'        => $order->total,
    ]);
  }

  /**
   * Show make payment page
   */
  public function payment($orderNumber)
  {
    $order = Order::where('order_number', $orderNumber)
      ->with('items')
      ->first();

    if (!$order) {
      return redirect()
        ->route('homee')
        ->with('error', 'Order not found');
    }

    return view('frontend.pages.make_payment', compact('order'));
  }







  /*---------  Order Continues -----------*/
  public function ordrContinues(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'table_number' => 'required|string',
      'customer_name' => 'required|string|max:100',
      'customer_mobile' => 'required|string|max:20',
      'items' => 'required|array|min:1',
      'items.*.product_id' => 'required|exists:products,id',
      'items.*.quantity' => 'required|integer|min:1',
      'items.*.special_instructions' => 'nullable|string|max:500',
      'notes' => 'nullable|string|max:1000',
    ]);

    if ($validator->fails()) {
      return response()->json(
        [
          'success' => false,
          'message' => 'Validation failed',
          'errors' => $validator->errors(),
        ],
        422
      );
    }

    try {
      DB::beginTransaction();

      // Find or create table reference
      $table = Table::where('table_number', $request->table_number)->first();

      // Check for existing active order for this table and customer
      $existingOrder = Order::where('table_number', $request->table_number)
        ->where('customer_mobile', $request->customer_mobile)
        ->whereNotIn('status', ['completed', 'cancelled'])
        ->whereNotIn('payment_status', ['paid', 'pending_verification'])
        ->first();

      // Calculate totals for new items
      $additionalSubtotal = 0;
      $orderItems = [];

      foreach ($request->items as $item) {
        $product = Products::findOrFail($item['product_id']);
        $price = $product->discount_price > 0 ? $product->discount_price : $product->price;
        $itemTotal = $price * $item['quantity'];
        $additionalSubtotal += $itemTotal;

        $orderItems[] = [
          'product_id' => $product->id,
          'product_name' => $product->name,
          'price' => $price,
          'quantity' => $item['quantity'],
          'total' => $itemTotal,
          'special_instructions' => $item['special_instructions'] ?? null,
        ];
      }

      if ($existingOrder) {
        // Update existing order
        $existingOrder->subtotal += $additionalSubtotal;
        $existingOrder->total += $additionalSubtotal;

        // Determine next batch suffix
        $lastBatch = $existingOrder
          ->items()
          ->whereNotNull('batch_group')
          ->orderBy('batch_group', 'desc')
          ->first();
        $nextBatch = 'a';
        if ($lastBatch) {
          $nextBatch = ++$lastBatch->batch_group;
        } else {
          // Check if there are items without batch group (first round)
          $hasItems = $existingOrder->items()->count() > 0;
          $nextBatch = $hasItems ? 'b' : 'a';
        }

        // If there are new notes, append them
        if ($request->notes) {
          $existingOrder->notes = $existingOrder->notes
            ? $existingOrder->notes . "\n---\n" . $request->notes
            : $request->notes;
        }

        $existingOrder->save();
        $order = $existingOrder;
        $orderBatch = $nextBatch;
        $message = 'Items added to your existing order successfully!';
      } else {
        // Create new order
        $order = Order::create([
          'order_number' => Order::generateOrderNumber(),
          'table_id' => $table?->id,
          'table_number' => $request->table_number,
          'customer_name' => $request->customer_name,
          'customer_mobile' => $request->customer_mobile,
          'subtotal' => $additionalSubtotal,
          'tax' => 0,
          'discount' => 0,
          'total' => $additionalSubtotal,
          'status' => 'pending',
          'payment_status' => 'unpaid',
          'notes' => $request->notes,
        ]);
        $orderBatch = 'a';
        $message = 'Order placed successfully!';
      }

      // Create order items
      foreach ($orderItems as $item) {
        $item['batch_group'] = $orderBatch;
        $item['status'] = 'pending';
        $order->items()->create($item);
      }

      // Store customer info in session for persistence
      session([
        'customer_name' => $request->customer_name,
        'customer_mobile' => $request->customer_mobile,
      ]);

      DB::commit();

      return response()->json([
        'success' => true,
        'message' => $message,
        'order' => [
          'id' => $order->id,
          'order_number' => $order->order_number,
          'table_number' => $order->table_number,
          'total' => $order->total,
          'status' => $order->status,
          'items_count' => $order->items()->count(),
        ],
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(
        [
          'success' => false,
          'message' => 'Failed to place order: ' . $e->getMessage(),
        ],
        500
      );
    }
  }

  /*---------  Oeder pay Payment -----------*/
  public function payPayment($orderNumber)
  {
    $order = Order::where('order_number', $orderNumber)
      ->with('items')
      ->first();

    if (!$order) {
      return redirect()
        ->route('homee')
        ->with('error', 'Order not found');
    }



    return view('frontend.pages.order_pay_payment', compact('order'));
  }


  /*------ Customer UPI Payment Self-Confirmation -------*/
  public function confirmUpiPayment(Request $request, $encrypted_id)
  {
    // dd($request->all());
    $validator = Validator::make($request->all(), [
      'utr_number' => 'required|string|min:6|max:25|regex:/^[A-Za-z0-9]+$/',
    ], [
      'utr_number.required'  => 'Please enter your UTR / Transaction ID.',
      'utr_number.min'       => 'UTR must be at least 6 characters.',
      'utr_number.max'       => 'UTR must be at most 25 characters.',
      'utr_number.regex'     => 'UTR must contain only letters and numbers.',
    ]);

    // dd($validator);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => $validator->errors()->first('utr_number'),
      ], 422);
    }


    try {
      $id    = decrypt($encrypted_id);
      $order = Order::findOrFail($id);

      if ($order->payment_status === 'paid') {
        return response()->json([
          'success' => false,
          'message' => 'This order is already marked as paid.',
        ], 400);
      }

      if ($order->payment_status === 'pending_verification') {
        return response()->json([
          'success' => false,
          'message' => 'Payment already submitted and is awaiting verification.',
        ], 400);
      }

      $utr = strtoupper(trim($request->utr_number));

      // Append UTR to notes (no migration needed)
      $utrNote = "[UPI UTR: {$utr} | Submitted: " . now()->format('d M Y h:i A') . "]";
      $order->notes = $order->notes
        ? $order->notes . "\n" . $utrNote
        : $utrNote;

      $order->payment_status = 'pending_verification';
      $order->payment_method = 'upi';
      $order->save();

      return response()->json([
        'success' => true,
        'message' => 'Payment submitted! Our staff will verify your transaction shortly.',
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Something went wrong. Please try again.',
      ], 500);
    }
  }

  /*------ Payment Related Generate Upi Code -------*/
  public function paymentgenerateUpiQr($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $order = Order::findOrFail($id);

      if ($order->payment_status === 'paid') {
        return response()->json(
          [
            'success' => false,
            'message' => 'Payment already completed for this order.',
          ],
          400
        );
      }

      $upiService = new UpiPaymentService();
      $qrData = $upiService->generateOrderPaymentQr($order->total, $order->order_number);

      return response()->json([
        'success' => true,
        'data' => $qrData,
      ]);
    } catch (\Exception $e) {
      return response()->json(
        [
          'success' => false,
          'message' => $e->getMessage(),
        ],
        500
      );
    }
  }
}
