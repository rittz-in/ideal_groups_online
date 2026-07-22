<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use App\Models\Table;
use App\Services\UpiPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OrdersController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Display order listing page
   */
  public function index()
  {
    return view('content.apps.orders.list');
  }

  /**
   * Get all orders for DataTable
   */
  public function getAll(Request $request)
  {
    $query = Order::with(['items', 'table'])->orderBy('created_at', 'desc');

    // Filter by status
    if ($request->has('status') && $request->status !== 'all') {
      if ($request->status === 'confirmed') {
        $query->whereIn('status', ['confirmed', 'preparing', 'ready', 'served']);
      } else {
        $query->where('status', $request->status);
      }
    }

    // Filter by payment status
    if ($request->has('payment_status') && $request->payment_status !== 'all') {
      $query->where('payment_status', $request->payment_status);
    }

    // Filter by date
    if ($request->has('filter_type')) {
      if ($request->filter_type === 'daily' && $request->has('date') && $request->date) {
        $query->whereDate('created_at', $request->date);
      } elseif ($request->filter_type === 'monthly' && $request->has('month') && $request->month) {
        $monthYear = explode('-', $request->month);
        $query->whereYear('created_at', $monthYear[0])->whereMonth('created_at', $monthYear[1]);
      }
    } elseif ($request->has('date') && $request->date) {
      $query->whereDate('created_at', $request->date);
    }

    return DataTables::of($query)
      ->addColumn('encrypted_id', function ($order) {
        return encrypt($order->id);
      })
      ->addColumn('items_count', function ($order) {
        return $order->items->sum('quantity');
      })
      ->addColumn('status_badge', function ($order) {
        $color = 'secondary';
        $displayStatus = $order->status;

        if (in_array($order->status, ['confirmed', 'preparing', 'ready', 'served'])) {
          $color = 'info';
          $displayStatus = 'confirmed';
        } elseif ($order->status === 'pending') {
          $color = 'warning';
        } elseif ($order->status === 'completed') {
          $color = 'success';
        } elseif ($order->status === 'cancelled') {
          $color = 'danger';
        }

        return '<span class="badge bg-label-' . $color . '">' . ucfirst($displayStatus) . '</span>';
      })
      ->addColumn('payment_badge', function ($order) {
        $color = $order->payment_status === 'paid' ? 'success' : 'warning';
        return '<span class="badge bg-label-' . $color . '">' . ucfirst($order->payment_status) . '</span>';
      })
      ->addColumn('created_time', function ($order) {
        return $order->created_at->format('d M Y h:i A');
      })
      ->addColumn('actions', function ($order) {
        $encrypted = encrypt($order->id);
        return '
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="' .
          route('app-orders-view', $encrypted) .
          '">
                                <i class="ti ti-eye me-1"></i> View
                            </a>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="printOrder(\'' .
          $encrypted .
          '\')">
                                <i class="ti ti-printer me-1"></i> Print
                            </a>
                            <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="deleteOrder(\'' .
          $encrypted .
          '\')">
                                <i class="ti ti-trash me-1"></i> Delete
                            </a>
                        </div>
                    </div>
                ';
      })
      ->rawColumns(['status_badge', 'payment_badge', 'actions'])
      ->make(true);
  }

  /**
   * View single order details
   */
  public function view($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $order = Order::with(['items.product', 'table'])->findOrFail($id);
      return view('content.apps.orders.view', compact('order'));
    } catch (\Exception $e) {
      return redirect()
        ->route('app-orders-list')
        ->with('error', 'Order not found.');
    }
  }

  /**
   * Update order status
   */
  public function updateStatus(Request $request, $encrypted_id)
  {
    try {
      $request->validate([
        'status' => 'required|in:pending,confirmed,preparing,ready,served,completed,cancelled',
      ]);

      $id = decrypt($encrypted_id);
      $order = Order::findOrFail($id);

      $order->status = $request->status;

      // Update timestamps based on status
      switch ($request->status) {
        case 'confirmed':
          $order->confirmed_at = now();
          break;
        case 'ready':
          $order->prepared_at = now();
          break;
        case 'served':
          $order->served_at = now();
          break;
        case 'completed':
          $order->completed_at = now();
          break;
      }

      $order->save();

      return response()->json([
        'success' => true,
        'message' => 'Order status updated successfully!',
        'status' => $order->status,
      ]);
    } catch (\Exception $e) {
      return response()->json(
        [
          'success' => false,
          'message' => 'Failed to update order status: ' . $e->getMessage(),
        ],
        500
      );
    }
  }

  /**
   * Update payment status
   */
  public function updatePayment(Request $request, $encrypted_id)
  {
    try {
      $request->validate([
        'payment_status' => 'required|in:unpaid,paid',
        'payment_method' => 'nullable|in:cash,card,upi',
      ]);

      $id = decrypt($encrypted_id);
      $order = Order::findOrFail($id);

      $order->payment_status = $request->payment_status;
      if ($request->payment_method) {
        $order->payment_method = $request->payment_method;
      }

      if ($request->payment_status === 'paid') {
        $order->status = 'completed';
        $order->completed_at = now();
      }

      $order->save();

      return response()->json([
        'success' => true,
        'message' => 'Payment status updated and order marked as completed!',
      ]);
    } catch (\Exception $e) {
      return response()->json(
        [
          'success' => false,
          'message' => 'Failed to update payment: ' . $e->getMessage(),
        ],
        500
      );
    }
  }

  /**
   * Get order statistics
   */
  public function statistics()
  {
    $today = now()->toDateString();

    $stats = [
      'total_orders' => Order::whereDate('created_at', $today)->count(),
      'pending_orders' => Order::whereDate('created_at', $today)
        ->where('status', 'pending')
        ->count(),
      'confirmed_orders' => Order::whereDate('created_at', $today)
        ->whereIn('status', ['confirmed', 'preparing', 'ready', 'served'])
        ->count(),
      'completed_orders' => Order::whereDate('created_at', $today)
        ->where('status', 'completed')
        ->count(),
      'total_revenue' => Order::whereDate('created_at', $today)
        ->where('payment_status', 'paid')
        ->sum('total'),
      'unpaid_amount' => Order::whereDate('created_at', $today)
        ->where('payment_status', 'unpaid')
        ->whereNotIn('status', ['cancelled'])
        ->sum('total'),
    ];

    return response()->json($stats);
  }

  /**
   * Print order receipt
   */
  public function print($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $order = Order::with(['items.product', 'table'])->findOrFail($id);
      return view('content.apps.orders.print', compact('order'));
    } catch (\Exception $e) {
      return redirect()
        ->route('app-orders-list')
        ->with('error', 'Order not found.');
    }
  }

  /**
   * Kitchen display - active orders
   */
  public function kitchen()
  {
    return view('content.apps.orders.kitchen');
  }

  /**
   * Get active orders for kitchen display
   */
  public function getActiveOrders()
  {
    $orders = Order::with([
      'items' => function ($query) {
        $query->where('status', '!=', 'cancelled');
      },
    ])
      ->whereIn('status', ['pending', 'confirmed', 'preparing', 'ready', 'served'])
      ->orderBy('created_at', 'asc')
      ->get();

    $activeBatches = [];

    foreach ($orders as $order) {
      $batches = $order->items->groupBy('batch_group');

      foreach ($batches as $batchKey => $items) {
        if ($items->count() === 0) {
          continue;
        }

        $suffix = $batchKey ?: 'a';
        $activeBatches[] = [
          'id' => $order->id,
          'encrypted_id' => encrypt($order->id),
          'order_number' => $order->order_number . '_' . $suffix,
          'display_number' => substr($order->order_number, -4) . '_' . $suffix,
          'table_number' => $order->table_number,
          'customer_name' => $order->customer_name,
          'status' => $order->status,
          'items' => $items->map(function ($item) {
            return [
              'id' => $item->id,
              'encrypted_id' => encrypt($item->id),
              'name' => $item->product_name,
              'quantity' => $item->quantity,
              'instructions' => $item->special_instructions,
            ];
          }),
          'created_at' => $order->created_at->diffForHumans(),
          'time_elapsed' => $order->created_at->diffInMinutes(now()),
        ];
      }
    }

    return response()->json($activeBatches);
  }

  /**
   * Cancel individual order item
   */
  public function cancelItem($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $item = OrderItem::findOrFail($id);
      $order = $item->order;

      $item->status = 'cancelled';
      $item->save();

      // Recalculate order totals
      $activeItems = $order
        ->items()
        ->where('status', '!=', 'cancelled')
        ->get();

      if ($activeItems->count() === 0) {
        $order->status = 'cancelled';
        $order->subtotal = 0;
        $order->total = 0;
      } else {
        $newSubtotal = $activeItems->sum('total');
        $order->subtotal = $newSubtotal;
        $order->total = $newSubtotal; // Adjust if tax/discount logic changes
      }

      $order->save();

      return response()->json([
        'success' => true,
        'message' => 'Item removed from order successfully!',
      ]);
    } catch (\Exception $e) {
      return response()->json(
        [
          'success' => false,
          'message' => 'Failed to remove item: ' . $e->getMessage(),
        ],
        500
      );
    }
  }

  /**
   * Generate UPI QR code for order payment
   */
  public function generateUpiQr($encrypted_id)
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

  /**
   * Delete an order
   */
  public function destroy($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $order = Order::findOrFail($id);

      // Delete associated items
      $order->items()->delete();

      // Delete order
      $order->delete();

      return response()->json([
        'success' => true,
        'message' => 'Order deleted successfully!',
      ]);
    } catch (\Exception $e) {
      return response()->json(
        [
          'success' => false,
          'message' => 'Failed to delete order: ' . $e->getMessage(),
        ],
        500
      );
    }
  }
}
