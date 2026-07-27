<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card p-5">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">

                                    <h5 class="">View Product</h5>

                                </div>
                                <div class="col-6 text-end">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
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


                                <div class="row">
                                    <!-- order_details.html -->

                                    <h1>Order Details</h1>

                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="order_id">Order ID:</label>
                                        <input class="form-control" type="text" id="order_id" name="order_id"
                                            value="{{ $order->id }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="guest_id">Guest ID:</label>
                                        <input class="form-control" type="text" id="guest_id" name="guest_id"
                                            value="{{ $order->guest_id }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="user_id">User ID:</label>
                                        <input class="form-control" type="text" id="user_id" name="user_id"
                                            value="{{ $order->user_id }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="order_status">Order Status:</label>
                                        <input class="form-control" type="text" id="order_status" name="order_status"
                                            value="{{ $order->order_status }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="order_type">Order Type:</label>
                                        <input class="form-control" type="text" id="order_type" name="order_type"
                                            value="{{ $order->order_type }}" readonly>
                                    </div>
                                    {{-- <div class="col-md-4 mb-2">
                                        <label class="form-label"for="card_type">Card Type:</label>
                                        <input class="form-control" type="text" id="card_type" name="card_type"
                                            value="{{ $order->card_type }}" readonly>
                                    </div> --}}
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="transaction_id">Transaction ID:</label>
                                        <input class="form-control" type="text" id="transaction_id"
                                            name="transaction_id" value="{{ $order->transaction_id }}" readonly>
                                    </div>
                                    {{-- <div class="col-md-4 mb-2">
                                        <label class="form-label"for="auth_code">Auth Code:</label>
                                        <input class="form-control" type="text" id="auth_code" name="auth_code"
                                            value="{{ $order->auth_code }}" readonly>
                                    </div> --}}
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label" for="response_code">Response Code:</label>
                                        <textarea class="form-control" id="response_code" name="response_code" readonly>{{ $order->response_code }}</textarea>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="response_desc">Response Description:</label>
                                        <input class="form-control" type="text" id="response_desc"
                                            name="response_desc" value="{{ $order->response_desc }}" readonly>
                                    </div>
                                    {{-- <div class="col-md-4 mb-2">
                                        <label class="form-label"for="payment_response">Payment Response:</label>
                                        <input class="form-control" type="text" id="payment_response"
                                            name="payment_response" value="{{ $order->payment_response }}" readonly>
                                    </div> --}}
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="total_amount">Total Amount:</label>
                                        <input class="form-control" type="text" id="total_amount" name="total_amount"
                                            value="{{ $order->total_amount }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="fname">First Name:</label>
                                        <input class="form-control" type="text" id="fname" name="fname"
                                            value="{{ $order->fname }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="lname">Last Name:</label>
                                        <input class="form-control" type="text" id="lname" name="lname"
                                            value="{{ $order->lname }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="username">Username:</label>
                                        <input class="form-control" type="text" id="username" name="username"
                                            value="{{ $order->username }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="email">Email:</label>
                                        <input class="form-control" type="text" id="email" name="email"
                                            value="{{ $order->email }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="mobile">Mobile:</label>
                                        <input class="form-control" type="text" id="mobile" name="mobile"
                                            value="{{ $order->mobile }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="address1">Address 1:</label>
                                        <input class="form-control" type="text" id="address1" name="address1"
                                            value="{{ $order->address1 }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="address2">Address 2:</label>
                                        <input class="form-control" type="text" id="address2" name="address2"
                                            value="{{ $order->address2 }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="country">Country:</label>
                                        <input class="form-control" type="text" id="country" name="country"
                                            value="{{ $order->country }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="state">State:</label>
                                        <input class="form-control" type="text" id="state" name="state"
                                            value="{{ $order->state }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="zip">ZIP:</label>
                                        <input class="form-control" type="text" id="zip" name="zip"
                                            value="{{ $order->zip }}" readonly>
                                    </div>
                                    <hr style="height: 10px;"
                                        class=" @php if ($order->differentShipping) { echo 'bg-success'; } else { echo 'bg-danger'; } @endphp">

                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="s_fname">Shipping First Name:</label>
                                        <input class="form-control" type="text" id="s_fname" name="s_fname"
                                            value="{{ $order->s_fname }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="s_lname">Shipping Last Name:</label>
                                        <input class="form-control" type="text" id="s_lname" name="s_lname"
                                            value="{{ $order->s_lname }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="s_username">Shipping Username:</label>
                                        <input class="form-control" type="text" id="s_username" name="s_username"
                                            value="{{ $order->s_username }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="s_email">Shipping Email:</label>
                                        <input class="form-control" type="text" id="s_email" name="s_email"
                                            value="{{ $order->s_email }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="s_mobile">Shipping Mobile:</label>
                                        <input class="form-control" type="text" id="s_mobile" name="s_mobile"
                                            value="{{ $order->s_mobile }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="s_address1">Shipping Address 1:</label>
                                        <input class="form-control" type="text" id="s_address1" name="s_address1"
                                            value="{{ $order->s_address1 }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="s_address2">Shipping Address 2:</label>
                                        <input class="form-control" type="text" id="s_address2" name="s_address2"
                                            value="{{ $order->s_address2 }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="s_country">Shipping Country:</label>
                                        <input class="form-control" type="text" id="s_country" name="s_country"
                                            value="{{ $order->s_country }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="s_state">Shipping State:</label>
                                        <input class="form-control" type="text" id="s_state" name="s_state"
                                            value="{{ $order->s_state }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="s_zip">Shipping ZIP:</label>
                                        <input class="form-control" type="text" id="s_zip" name="s_zip"
                                            value="{{ $order->s_zip }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label"for="created_at">Created At:</label>
                                        <input class="form-control" type="text" id="created_at" name="created_at"
                                            value="{{ $order->created_at }}" readonly>
                                    </div>
                                    {{-- <div class="col-md-4 mb-2">
                                        <label class="form-label"for="updated_at">Updated At:</label>
                                        <input class="form-control" type="text" id="updated_at" name="updated_at"
                                            value="{{ $order->updated_at }}">

                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-app.footer />
    </main>
</x-app-layout>

<style>
    .varientCreate {
        margin-top: 30px;
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function RemoveProductImage(message, link) {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {

                window.location.href = link.href;
            }
        });

        return false;
    }

    $(document).ready(function() {

        $("#order_type").change(function() {
            $val = $(this).val();

            if ($val == 'Varient') {
                $(".varientNameSection").show();
            } else {
                $(".varientNameSection").hide();
            }
        });


        $("#varient_name").change(function() {
            $(".varientTypeSection").hide();
        });















    });
</script>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
