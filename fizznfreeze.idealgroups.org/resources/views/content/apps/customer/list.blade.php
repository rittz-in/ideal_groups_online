@extends('layouts/layoutMaster')

@section('title', 'Customer List')

@section('vendor-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="https://unpkg.com/feather-icons"></script>
@endsection

@section('content')
    <section class="app-customer-list">
        <!-- list and filter start -->
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Customers List</h4>
                <a href="{{ route('app-customers-export-pdf') }}" class="btn btn-success">
                    <i class="ti ti-file-description me-1"></i> Download PDF
                </a>
            </div>
            <div class="card-body">
                <div class="card-datatable table-responsive pt-0">
                    <table class="customer-list-table table dt-responsive w-100" id="customers-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Last Order Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- list and filter end -->
    </section>
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            var dt_customer = $('#customers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('app-customers-get-all') }}",
                columns: [
                    {
                        data: 'customer_name',
                        name: 'customer_name'
                    },
                    {
                        data: 'customer_mobile',
                        name: 'customer_mobile'
                    },
                    {
                        data: 'last_order',
                        name: 'last_order_date'
                    },
                    {
                        data: 'customer_mobile',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return (
                                '<div class="d-flex align-items-center">' +
                                '<button class="btn btn-sm btn-icon delete-record" data-mobile="' + data + '">' +
                                '<i class="ti ti-trash"></i>' +
                                '</button>' +
                                '</div>'
                            );
                        }
                    }
                ],
                order: [[2, 'desc']],
                drawCallback: function() {
                    feather.replace();
                },
                dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                language: {
                    paginate: {
                        next: '<i class="ti ti-chevron-right ti-xs"></i>',
                        previous: '<i class="ti ti-chevron-left ti-xs"></i>'
                    }
                }
            });

            // Delete Record
            $(document).on('click', '.delete-record', function() {
                var mobile = $(this).data('mobile');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Deleteting this customer will remove all their order history! This action is irreversible.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('app/customers/destroy') }}/" + mobile,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    dt_customer.draw();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: response.message,
                                        customClass: {
                                            confirmButton: 'btn btn-success'
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.message,
                                        icon: 'error',
                                        customClass: {
                                            confirmButton: 'btn btn-primary'
                                        }
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while deleting the customer.',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection