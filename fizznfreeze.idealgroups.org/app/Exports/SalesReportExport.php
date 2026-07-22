<?php

namespace App\Exports;

use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalesReportExport implements FromQuery, WithHeadings, WithMapping
{
  protected $request;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function query()
  {
    $query = OrderItem::query()
      ->select([
        'order_items.product_name',
        'order_items.price',
        'order_items.quantity',
        'order_items.total',
        'orders.order_number',
        'orders.customer_name',
        'orders.customer_mobile',
        'orders.created_at',
        'products.category_name',
      ])
      ->join('orders', 'order_items.order_id', '=', 'orders.id')
      ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
      ->whereNull('orders.deleted_at');

    // Date Filtering
    if ($this->request->filter_type == 'daily') {
      $query->whereDate('orders.created_at', Carbon::today());
    } elseif ($this->request->filter_type == 'monthly') {
      $query
        ->whereMonth('orders.created_at', Carbon::now()->month)
        ->whereYear('orders.created_at', Carbon::now()->year);
    } elseif ($this->request->filter_type == 'yearly') {
      $query->whereYear('orders.created_at', Carbon::now()->year);
    } elseif ($this->request->filter_type == 'custom' && $this->request->start_date && $this->request->end_date) {
      $query->whereBetween('orders.created_at', [
        Carbon::parse($this->request->start_date)->startOfDay(),
        Carbon::parse($this->request->end_date)->endOfDay(),
      ]);
    }

    // Category Filtering
    if ($this->request->category && $this->request->category != 'all') {
      $query->where('products.category_name', $this->request->category);
    }

    return $query;
  }

  public function headings(): array
  {
    return ['Order #', 'Customer Name', 'Mobile', 'Product', 'Category', 'Price', 'Quantity', 'Total', 'Date'];
  }

  public function map($row): array
  {
    return [
      $row->order_number,
      $row->customer_name,
      $row->customer_mobile,
      $row->product_name,
      $row->category_name,
      $row->price,
      $row->quantity,
      $row->total,
      Carbon::parse($row->created_at)->format('d M Y h:i A'),
    ];
  }
}
