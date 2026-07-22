<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CustomerController extends Controller
{
  /**
   * Display a listing of unique customers.
   *
   * @return \Illuminate\View\View
   */
  public function index()
  {
    return view('content.apps.customer.list');
  }

  /**
   * Get all unique customers for DataTables.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getAll()
  {
    $customers = Order::select('customer_name', 'customer_mobile', DB::raw('MAX(created_at) as last_order_date'))
      ->groupBy('customer_mobile', 'customer_name')
      ->orderBy('last_order_date', 'desc')
      ->get();

    return DataTables::of($customers)
      ->addColumn('last_order', function ($row) {
        return $row->last_order_date ? \Carbon\Carbon::parse($row->last_order_date)->format('d M Y h:i A') : '';
      })
      ->make(true);
  }

  /**
   * Export unique customers to PDF.
   *
   * @return \Illuminate\Http\Response
   */
  public function exportPdf()
  {
    $customers = Order::select('customer_name', 'customer_mobile', DB::raw('MAX(created_at) as last_order_date'))
      ->groupBy('customer_mobile', 'customer_name')
      ->orderBy('last_order_date', 'desc')
      ->get();

    $logoPath = public_path('assets/img/fizzfavicon.svg');
    $logoBase64 = '';
    if (file_exists($logoPath)) {
      $logoData = base64_encode(file_get_contents($logoPath));
      $logoBase64 = 'data:image/svg+xml;base64,' . $logoData;
    }

    $pdf = Pdf::loadView('content.apps.customer.customer-list-pdf', [
      'customers' => $customers,
      'logoBase64' => $logoBase64,
    ]);

    return $pdf->download('customer_list_' . now()->format('Y-m-d_His') . '.pdf');
  }

  /**
   * Delete a customer (deletes all orders associated with their mobile number).
   *
   * @param string $mobile
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy($mobile)
  {
    try {
      DB::beginTransaction();

      // Find and delete all orders with this mobile number
      Order::where('customer_mobile', $mobile)->delete();

      DB::commit();

      return response()->json([
        'success' => true,
        'message' => 'Customer and all associated orders deleted successfully.',
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json([
        'success' => false,
        'message' => 'An error occurred while deleting the customer: ' . $e->getMessage(),
      ], 500);
    }
  }
}