<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesReportExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
  public function index()
  {
    $categories = Category::where('status', 'active')->get();
    return view('content.apps.reports.sales', compact('categories'));
  }

  public function salesData(Request $request)
  {
    $query = $this->getFilteredQuery($request);

    return DataTables::of($query)
      ->editColumn('created_at', function ($row) {
        return Carbon::parse($row->created_at)->format('d M Y h:i A');
      })
      ->editColumn('total', function ($row) {
        return number_format($row->total, 2);
      })
      ->make(true);
  }

  protected function getFilteredQuery(Request $request)
  {
    $query = OrderItem::query()
      ->select([
        'order_items.id',
        'order_items.product_name',
        'order_items.price',
        'order_items.quantity',
        'order_items.total',
        'orders.order_number',
        'orders.customer_name',
        'orders.customer_mobile',
        'orders.status as order_status',
        'orders.created_at as created_at',
        'products.category_name',
      ])
      ->join('orders', 'order_items.order_id', '=', 'orders.id')
      ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
      ->whereNull('orders.deleted_at');

    // Date Filtering
    $filterType = $request->get('filter_type', 'daily');

    if ($filterType == 'daily') {
      $query->whereDate('orders.created_at', Carbon::today());
    } elseif ($filterType == 'monthly') {
      $query
        ->whereMonth('orders.created_at', Carbon::now()->month)
        ->whereYear('orders.created_at', Carbon::now()->year);
    } elseif ($filterType == 'yearly') {
      $query->whereYear('orders.created_at', Carbon::now()->year);
    } elseif ($filterType == 'custom' && $request->start_date && $request->end_date) {
      $query->whereBetween('orders.created_at', [
        Carbon::parse($request->start_date)->startOfDay(),
        Carbon::parse($request->end_date)->endOfDay(),
      ]);
    }

    // Category Filtering
    if ($request->category && $request->category != 'all') {
      $query->where(function ($q) use ($request) {
        $q->where('products.category_name', $request->category)->orWhere(
          'order_items.product_name',
          'like',
          '%' . $request->category . '%'
        );
      });
    }

    return $query;
  }

  public function exportExcel(Request $request)
  {
    $fileName = 'sales_report_' . now()->format('Y-m-d_His') . '.xlsx';
    return Excel::download(new SalesReportExport($request), $fileName);
  }

  public function exportPdf(Request $request)
  {
    $data = $this->getFilteredQuery($request)->get();
    $total_sales = $data->sum('total');
    $total_qty = $data->sum('quantity');
    $logoPath = public_path('assets/img/fizzfavicon.svg');
    $logoBase64 = '';
    if (file_exists($logoPath)) {
      $logoData = base64_encode(file_get_contents($logoPath));
      $logoBase64 = 'data:image/svg+xml;base64,' . $logoData;
    }

    $pdf = Pdf::loadView('content.apps.reports.sales-pdf', [
      'data' => $data,
      'total_sales' => $total_sales,
      'total_qty' => $total_qty,
      'filter_type' => $request->filter_type,
      'start_date' => $request->start_date,
      'end_date' => $request->end_date,
      'category' => $request->category,
      'logoBase64' => $logoBase64,
    ]);

    return $pdf->download('sales_report_' . now()->format('Y-m-d_His') . '.pdf');
  }
}
