@extends('layouts/layoutMaster')

@section('title', 'Sales Reports')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sales Reports /</span> Reports
</h4>

<div class="card mb-4">
  <div class="card-body">
    <form id="report-filter-form" class="row g-3">
      <div class="col-md-3">
        <label class="form-label" for="filter_type">Filter Type</label>
        <select id="filter_type" name="filter_type" class="form-select">
          <option value="daily">Daily</option>
          <option value="monthly">Monthly</option>
          <option value="yearly">Yearly</option>
          <option value="custom">Custom Range</option>
        </select>
      </div>
      <div id="custom-date-range" class="col-md-5 d-none">
        <div class="row">
          <div class="col-md-6">
            <label class="form-label" for="start_date">Start Date</label>
            <input type="text" id="start_date" name="start_date" class="form-control flatpickr-input" placeholder="YYYY-MM-DD" />
          </div>
          <div class="col-md-6">
            <label class="form-label" for="end_date">End Date</label>
            <input type="text" id="end_date" name="end_date" class="form-control flatpickr-input" placeholder="YYYY-MM-DD" />
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <label class="form-label" for="category_filter">Category</label>
        <select id="category_filter" name="category" class="form-select">
          <option value="all">All Categories</option>
          @foreach($categories as $category)
          <option value="{{$category->name}}">{{$category->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-1 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">Filter</button>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header border-bottom d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">Sales Data</h5>
    <div class="d-flex gap-2">
      <button id="export-excel" class="btn btn-success"><i class="ti ti-file-spreadsheet me-1"></i> Excel</button>
      <button id="export-pdf" class="btn btn-success"><i class="ti ti-file-description me-1"></i> PDF</button>
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-reports table border-top">
      <thead>
        <tr>
          <th>Order #</th>
          <th>Customer</th>
          <th>Mobile</th>
          <th>Product</th>
          <th>Category</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Total</th>
          <th>Date</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@endsection

@section('page-script')
<script>
$(function () {
  var dt_reports_table = $('.datatables-reports');
  var filterForm = $('#report-filter-form');
  var customDateRange = $('#custom-date-range');

  // Flatpickr initialization
  $('#start_date, #end_date').flatpickr({
    dateFormat: 'Y-m-d'
  });

  $('#filter_type').on('change', function () {
    if ($(this).val() === 'custom') {
      customDateRange.removeClass('d-none');
    } else {
      customDateRange.addClass('d-none');
    }
  });

  if (dt_reports_table.length) {
    var dt_reports = dt_reports_table.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '{{ route("app-reports-sales-data") }}',
        data: function (d) {
          d.filter_type = $('#filter_type').val();
          d.start_date = $('#start_date').val();
          d.end_date = $('#end_date').val();
          d.category = $('#category_filter').val();
        }
      },
      columns: [
        { data: 'order_number' },
        { data: 'customer_name' },
        { data: 'customer_mobile' },
        { data: 'product_name' },
        { data: 'category_name' },
        { data: 'price' },
        { data: 'quantity' },
        { data: 'total' },
        { data: 'created_at' }
      ],
      order: [[8, 'desc']],
      dom: '<"row me-2"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"f>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
    });
  }

  filterForm.on('submit', function (e) {
    e.preventDefault();
    dt_reports.draw();
  });

  $('#export-excel').on('click', function () {
    var params = $.param({
      filter_type: $('#filter_type').val(),
      start_date: $('#start_date').val(),
      end_date: $('#end_date').val(),
      category: $('#category_filter').val()
    });
    window.location.href = "{{ route('app-reports-sales-export-excel') }}?" + params;
  });

  $('#export-pdf').on('click', function () {
    var params = $.param({
      filter_type: $('#filter_type').val(),
      start_date: $('#start_date').val(),
      end_date: $('#end_date').val(),
      category: $('#category_filter').val()
    });
    window.location.href = "{{ route('app-reports-sales-export-pdf') }}?" + params;
  });
});
</script>
@endsection
