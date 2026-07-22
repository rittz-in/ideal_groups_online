@extends('layouts/layoutMaster')

@section('title', 'Orders List')

@section('vendor-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" />
    <style>
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 20px;
            color: white;
        }
        .stats-card.orange {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .stats-card.green {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .stats-card.blue {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
    </style>
@endsection

@section('vendor-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
@endsection


@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0 opacity-75">Today's Orders</h6>
                        <h2 class="mb-0" id="total-orders">0</h2>
                    </div>
                    <i class="ti ti-shopping-cart fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stats-card orange">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0 opacity-75">Pending</h6>
                        <h2 class="mb-0" id="pending-orders">0</h2>
                    </div>
                    <i class="ti ti-clock fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stats-card green">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0 opacity-75">Today's Revenue</h6>
                        <h2 class="mb-0">₹<span id="total-revenue">0</span></h2>
                    </div>
                    <i class="ti ti-currency-rupee fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stats-card blue">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0 opacity-75">Completed</h6>
                        <h2 class="mb-0" id="completed-orders">0</h2>
                    </div>
                    <i class="ti ti-check fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <section class="app-orders-list">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Orders List</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('app-orders-kitchen') }}" class="btn btn-warning">
                        <i class="ti ti-chef-hat me-1"></i> Kitchen Display
                    </a>
                    <button class="btn btn-primary" onclick="refreshTable()">
                        <i class="ti ti-refresh me-1"></i> Refresh
                    </button>
                </div>
            </div>
            
            <!-- Filters -->
            <div class="card-body border-bottom">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="filter-status">
                            <option value="all">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Payment Status</label>
                        <select class="form-select" id="filter-payment">
                            <option value="all">All</option>
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Filter Type</label>
                        <select class="form-select" id="filter-type">
                            <option value="daily">Daily</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                    <div class="col-md-3" id="date-filter-group">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" id="filter-date" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-3 d-none" id="month-filter-group">
                        <label class="form-label">Month</label>
                        <input type="month" class="form-control" id="filter-month" value="{{ date('Y-m') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-secondary w-100" onclick="applyFilters()" style="background-color: #440012">
                            <i class="ti ti-filter me-1"></i> Apply Filters
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="card-datatable table-responsive">
                    <table class="table dt-responsive w-100" id="orders-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Table</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-script')
    <script>
        var ordersTable;

        $(document).ready(function() {
            initDataTable();
            loadStatistics();

            $('#filter-type').on('change', function() {
                if ($(this).val() === 'daily') {
                    $('#date-filter-group').removeClass('d-none');
                    $('#month-filter-group').addClass('d-none');
                } else {
                    $('#date-filter-group').addClass('d-none');
                    $('#month-filter-group').removeClass('d-none');
                }
            });
            
            // Auto-refresh every 30 seconds
            setInterval(function() {
                refreshTable();
                loadStatistics();
            }, 30000);
        });

        function initDataTable() {
            ordersTable = $('#orders-table').DataTable({
                processing: true,
                serverSide: true,
                order: [[7, 'desc']],
                ajax: {
                    url: "{{ route('app-orders-get-all') }}",
                    data: function(d) {
                        d.status = $('#filter-status').val();
                        d.payment_status = $('#filter-payment').val();
                        d.filter_type = $('#filter-type').val();
                        d.date = $('#filter-date').val();
                        d.month = $('#filter-month').val();
                    }
                },
                columns: [
                    { data: 'order_number', name: 'order_number' },
                    { data: 'table_number', name: 'table_number' },
                    { 
                        data: 'customer_name', 
                        name: 'customer_name',
                        render: function(data, type, row) {
                            return `<div>
                                <strong>${data}</strong>
                                <br><small class="text-muted">${row.customer_mobile}</small>
                            </div>`;
                        }
                    },
                    { data: 'items_count', name: 'items_count', orderable: false },
                    { 
                        data: 'total', 
                        name: 'total',
                        render: function(data) {
                            return '₹' + parseFloat(data).toFixed(2);
                        }
                    },
                    { data: 'status_badge', name: 'status' },
                    { data: 'payment_badge', name: 'payment_status' },
                    { data: 'created_time', name: 'created_at' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                drawCallback: function() {
                    feather.replace();
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });
        }

        function refreshTable() {
            ordersTable.ajax.reload(null, false);
        }

        function applyFilters() {
            ordersTable.ajax.reload();
        }

        function loadStatistics() {
            $.get("{{ route('app-orders-statistics') }}", function(data) {
                $('#total-orders').text(data.total_orders);
                $('#pending-orders').text(data.pending_orders);
                $('#completed-orders').text(data.completed_orders);
                $('#total-revenue').text(parseFloat(data.total_revenue).toFixed(2));
            });
        }

        function printOrder(encryptedId) {
            window.open("{{ url('app/orders/print') }}/" + encryptedId, '_blank');
        }

        function deleteOrder(encryptedId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('app/orders/destroy') }}/" + encryptedId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                refreshTable();
                                loadStatistics();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'Failed to delete the order.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection
