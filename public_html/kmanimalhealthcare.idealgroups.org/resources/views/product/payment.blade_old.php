@extends('layouts.guest')
<link rel="stylesheet" href="{{ asset('siteassets/css/online_payment.css') }}">

@section('content')


<section class="  ">

    <div class="container">
        <h1>Order Details</h1>
        <div class="row order-detail">
            @if ($order_detail['guest_id'])
            <div class="col-md-4 form-group mt-2">
                <label for="guest_id">Guest ID:</label>
                <input type="text" id="guest_id" value="{{ $order_detail['guest_id'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['user_id'])
            <div class="col-md-4 form-group mt-2">
                <label for="user_id">User ID:</label>
                <input type="text" id="user_id" value="{{ $order_detail['user_id'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['order_status'])
            <div class="col-md-4 form-group mt-2">
                <label for="order_status">Order Status:</label>
                <input type="text" id="order_status" value="{{ $order_detail['order_status'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['order_type'])
            <div class="col-md-4 form-group mt-2">
                <label for="order_type">Order Type:</label>
                <input type="text" id="order_type" value="{{ $order_detail['order_type'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['card_type'])
            <div class="col-md-4 form-group mt-2">
                <label for="card_type">Card Type:</label>
                <input type="text" id="card_type" value="{{ $order_detail['card_type'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['transaction_id'])
            <div class="col-md-4 form-group mt-2">
                <label for="transaction_id">Transaction ID:</label>
                <input type="text" id="transaction_id" value="{{ $order_detail['transaction_id'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['auth_code'])
            <div class="col-md-4 form-group mt-2">
                <label for="auth_code">Auth Code:</label>
                <input type="text" id="auth_code" value="{{ $order_detail['auth_code'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['response_code'])
            <div class="col-md-4 form-group mt-2">
                <label for="response_code">Response Code:</label>
                <input type="text" id="response_code" value="{{ $order_detail['response_code'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['response_desc'])
            <div class="col-md-4 form-group mt-2">
                <label for="response_desc">Response Description:</label>
                <input type="text" id="response_desc" value="{{ $order_detail['response_desc'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['payment_response'])
            <div class="col-md-4 form-group mt-2">
                <label for="payment_response">Payment Response:</label>
                <input type="text" id="payment_response" value="{{ $order_detail['payment_response'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['total_amount'])
            <div class="col-md-4 form-group mt-2">
                <label for="total_amount">Total Amount:</label>
                <input type="text" id="total_amount" value="{{ $order_detail['total_amount'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['fname'])
            <div class="col-md-4 form-group mt-2">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" value="{{ $order_detail['fname'] }}" readonly class="form-group__input">
            </div>
            @endif
            @if ($order_detail['lname'])
            <div class="col-md-4 form-group mt-2">
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" value="{{ $order_detail['lname'] }}" readonly class="form-group__input">
            </div>
            @endif
            @if ($order_detail['username'])
            <div class="col-md-4 form-group mt-2">
                <label for="username">Username:</label>
                <input type="text" id="username" value="{{ $order_detail['username'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['email'])
            <div class="col-md-4 form-group mt-2">
                <label for="email">Email:</label>
                <input type="text" id="email" value="{{ $order_detail['email'] }}" readonly class="form-group__input">
            </div>
            @endif
            @if ($order_detail['mobile'])
            <div class="col-md-4 form-group mt-2">
                <label for="mobile">Mobile:</label>
                <input type="text" id="mobile" value="{{ $order_detail['mobile'] }}" readonly class="form-group__input">
            </div>
            @endif
            @if ($order_detail['address1'])
            <div class="col-md-4 form-group mt-2">
                <label for="address1">Address 1:</label>
                <input type="text" id="address1" value="{{ $order_detail['address1'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['address2'])
            <div class="col-md-4 form-group mt-2">
                <label for="address2">Address 2:</label>
                <input type="text" id="address2" value="{{ $order_detail['address2'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['country'])
            <div class="col-md-4 form-group mt-2">
                <label for="country">Country:</label>
                <input type="text" id="country" value="{{ $order_detail['country'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['state'])
            <div class="col-md-4 form-group mt-2">
                <label for="state">State:</label>
                <input type="text" id="state" value="{{ $order_detail['state'] }}" readonly class="form-group__input">
            </div>
            @endif
            @if ($order_detail['zip'])
            <div class="col-md-4 form-group mt-2">
                <label for="zip">ZIP:</label>
                <input type="text" id="zip" value="{{ $order_detail['zip'] }}" readonly class="form-group__input">
            </div>
            @endif
            @if ($order_detail['s_fname'])
            <div class="col-md-4 form-group mt-2">
                <label for="s_fname">Shipping First Name:</label>
                <input type="text" id="s_fname" value="{{ $order_detail['s_fname'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['s_lname'])
            <div class="col-md-4 form-group mt-2">
                <label for="s_lname">Shipping Last Name:</label>
                <input type="text" id="s_lname" value="{{ $order_detail['s_lname'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['s_username'])
            <div class="col-md-4 form-group mt-2">
                <label for="s_username">Shipping Username:</label>
                <input type="text" id="s_username" value="{{ $order_detail['s_username'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['s_email'])
            <div class="col-md-4 form-group mt-2">
                <label for="s_email">Shipping Email:</label>
                <input type="text" id="s_email" value="{{ $order_detail['s_email'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['s_mobile'])
            <div class="col-md-4 form-group mt-2">
                <label for="s_mobile">Shipping Mobile:</label>
                <input type="text" id="s_mobile" value="{{ $order_detail['s_mobile'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['s_address1'])
            <div class="col-md-4 form-group mt-2">
                <label for="s_address1">Shipping Address 1:</label>
                <input type="text" id="s_address1" value="{{ $order_detail['s_address1'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['s_address2'])
            <div class="col-md-4 form-group mt-2">
                <label for="s_address2">Shipping Address 2:</label>
                <input type="text" id="s_address2" value="{{ $order_detail['s_address2'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['s_country'])
            <div class="col-md-4 form-group mt-2">
                <label for="s_country">Shipping Country:</label>
                <input type="text" id="s_country" value="{{ $order_detail['s_country'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['s_state'])
            <div class="col-md-4 form-group mt-2">
                <label for="s_state">Shipping State:</label>
                <input type="text" id="s_state" value="{{ $order_detail['s_state'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['s_zip'])
            <div class="col-md-4 form-group mt-2">
                <label for="s_zip">Shipping ZIP:</label>
                <input type="text" id="s_zip" value="{{ $order_detail['s_zip'] }}" readonly class="form-group__input">
            </div>
            @endif
            @if ($order_detail['deleted_at'])
            <div class="col-md-4 form-group mt-2">
                <label for="deleted_at">Deleted At:</label>
                <input type="text" id="deleted_at" value="{{ $order_detail['deleted_at'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
            @if ($order_detail['differentShipping'])
            <div class="col-md-4 form-group mt-2">
                <label for="differentShipping">Different Shipping:</label>
                <input type="text" id="differentShipping" value="{{ $order_detail['differentShipping'] }}" readonly
                    class="form-group__input">
            </div>
            @endif
        </div>
    </div>
    <div class="card-body text-center hero">
        <form action="{{ route('razorpay.payment.store') }}" method="POST">
            @csrf
            <input type="hidden" class="form-group__input" name="id" value="{{ $order_detail->id }}"
                aria-describedby="helpId" placeholder="" />



            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}"
                data-amount="{{ $order_detail->total_amount * 100 }}"
                data-buttontext="Pay {{ $order_detail->total_amount }} INR" data-name="KM animal"
                data-description="Razorpay payment" data-image="{{ asset('siteassets/images/favicon.png') }}"
                data-prefill.name="ABC" data-prefill.email="abc@gmail.com" data-theme.color="#F7942A"></script>
        </form>
    </div>
</section>
@endsection