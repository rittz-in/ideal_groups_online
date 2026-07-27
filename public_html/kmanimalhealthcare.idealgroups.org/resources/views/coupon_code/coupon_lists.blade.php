<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">

                    <div class="card p-5">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">List of Coupons</h5>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('app-coupon_code-add') }}" class="btn btn-dark btn-primary">
                                        <i class="fas fa-category-plus me-2"></i>Add Coupon
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert" id="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert" id="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-secondary text-center data-table">
                                <thead>
                                    <tr>

                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Title</th>

                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Coupon Code</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Min Order Amount</th>


                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Start Date</th>


                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            End Date</th>


                                        {{-- <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Status</th> --}}
                                        {{-- <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Creation Date</th> --}}
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Action</th>
                                    </tr>
                                </thead>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>

</x-app-layout>
<script type="text/javascript">
    $(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('app-coupon_code-get-all') }}",
            columns: [{
                    data: 'coupon_name',
                    name: 'coupon_name'
                },
                {
                    data: 'coupon_code',
                    name: 'coupon_code'
                },

                {
                    data: 'min_order_amount',
                    name: 'min_order_amount'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                // {
                //     data: 'status',
                //     name: 'status',
                //     render: function(data) {

                //         if (data === 'on') {
                //             return '<span class="badge bg-success">Active</span>';
                //         } else {
                //             return '<span class="badge bg-danger">Inactive</span>';
                //         }
                //     }
                // },

                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ],
            order: [
                [0, 'desc']
            ],
        });

    });
</script>
<script src="/assets/js/plugins/datatables.js"></script>
<script>
    const dataTableBasic = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: true,
        columns: [{
            select: [2, 6],
            sortable: false
        }]
    });
</script>

<script>
    function deleteConfirm() {
        if (confirm("Are you sure to delete Coupon?")) {
            return true;
        }
        return false;
    }


    // function deleteConfirm(event) {
    // event.preventDefault(); // Prevent the default link behavior
    // Swal.fire({
    // title: 'Are you sure?',
    // text: "You won't be able to revert this!",
    // icon: 'warning',
    // showCancelButton: true,
    // confirmButtonColor: '#3085d6',
    // cancelButtonColor: '#d33',
    // confirmButtonText: 'Yes, delete it!'
    // }).then((result) => {
    // if (result.isConfirmed) {
    // // If category confirms, proceed with deletion by navigating to the route
    // var url = event.target.href;
    // window.location.href = url;
    // }
    // });
    // }
</script>
