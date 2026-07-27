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
                                    <h5 class="">order List</h5>
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
                            <table class="table text-secondary text-center data-table w-100">
                                <thead>
                                    <tr>

                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            ID</th>

                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Order Status</th>

                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            order Type</th>

                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Total Amount</th>

                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Date</th>
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
            ajax: "{{ route('app-order-get-all') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'order_status',
                    name: 'order_status'
                }, {
                    data: 'order_type',
                    name: 'order_type'
                }, {
                    data: 'total_amount',
                    name: 'total_amount'
                }, {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, full, meta) {
                        // Assuming 'created_at' is in ISO 8601 format
                        var date = new Date(data);
                        var currentDate = new Date();
                        var day = date.getDate();
                        var month = date.getMonth() + 1;
                        var year = date.getFullYear();

                        // Pad day and month with leading zeros if needed
                        day = day < 10 ? '0' + day : day;
                        month = month < 10 ? '0' + month : month;

                        var formattedDate = day + '-' + month + '-' + year;

                        // Check if the date is today
                        if (date.toDateString() === currentDate.toDateString()) {
                            return 'Today';
                        } else {
                            // Check if the date is yesterday
                            var yesterday = new Date(currentDate);
                            yesterday.setDate(currentDate.getDate() - 1);
                            if (date.toDateString() === yesterday.toDateString()) {
                                return 'Yesterday';
                            } else {
                                return formattedDate;
                            }
                        }
                    }
                }, {
                    data: 'actions',
                    name: 'actions'
                }


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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function deleteConfirm() {
        if (confirm("Are you sure to delete order?")) {
            return true;
        }
        return false;
    }
</script>
