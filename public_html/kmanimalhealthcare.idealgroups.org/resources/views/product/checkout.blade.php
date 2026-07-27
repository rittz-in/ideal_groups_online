@extends('layouts.guest')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('siteassets/css/cart.css') }}">

@section('content')
    <!-- Page Header Section Start Here -->
    <section class="page-header bg_img padding-tb">
        <div class="overlay"></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">Add to Cart</h4>
                <ul class="lab-ul">
                    <li><a href="">Home</a></li>
                    <li><a href="#" class="">Products</a></li>
                    <li><a class="active">Add to Cart</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page Header Section Ending Here -->
    <section class=" bg-gradient-faded-light    ">
        <div class="container">
            <div class="py-5 text-center">
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

            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-1">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill checkoutpagebtn">{{ count($viewCarts) }}</span>
                    </h4>
                    <ul class="list-group mb-1">

                        @php
                            $totalAmount = 0;
                        @endphp
                        {{-- {{ dd($viewCarts) }} --}}
                        @foreach ($viewCarts as $viewCart)
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{ $viewCart->productName }}</h6>
                                    <small class="text-muted">
                                        @if ($viewCart->variantSize == '')
                                            Quntity :- {{ $viewCart->quntity }}
                                        @else
                                            {{ $viewCart->variantSize }} * {{ $viewCart->quntity }}
                                        @endif

                                    </small>
                                </div>
                                <span class="text-muted">₹{{ $viewCart->total_amount }}</span>
                            </li>
                            @php
                                $totalAmount += $viewCart->total_amount;
                            @endphp
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between bg-light">

                            @if (!empty($checkCouponCode))
                                @php
                                    $couponCode = $checkCouponCode->coupon_code;
                                    if ($checkCouponCode->coupon_type == 'Percentage') {
                                        $discountAmount = ($totalAmount * $checkCouponCode->coupon_amount) / 100;
                                        $finalAmount = $totalAmount - $discountAmount;
                                    } else {
                                        $discountAmount = $checkCouponCode->coupon_amount;
                                        $finalAmount = $totalAmount - $discountAmount;
                                    }

                                @endphp
                            @else
                                @php
                                    $couponCode = '';
                                    $discountAmount = '0';
                                    $finalAmount = $totalAmount;
                                @endphp
                            @endif
                            <div class="text-success">
                                <h6 class="my-0">Promo code</h6>
                                <small>{{ $couponCode }}</small>
                            </div>
                            <span class="text-success">-₹<font>{{ $discountAmount }}</font></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (₹)</span>
                            <strong>₹<span class="totalAmount">{{ $finalAmount }}</span></strong>
                        </li>
                    </ul>


                </div>


                <div class="col-md-8 order-md-1">


                    @if ($userData == '')
                        <div class="col-md-12">
                            <h4>Are You a Login User?</h4>
                            <label class="radio-inline">
                                <input type="radio" name="logintype" class="logintype" value="Yes"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="logintype" class="logintype" value="No" checked> No
                            </label>
                            <div class="col-md-12 loginSection" style="display:none;">
                                <form class="needs-validation" method="post" action="{{ route('add-user-login') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="user_email">Email Address</label>
                                            <input type="email" class="form-control" id="user_email" name="user_email"
                                                required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="user_password">Password</label>
                                            <input type="password" class="form-control" id="user_password"
                                                name="user_password" required>
                                        </div>
                                        <div class='col-md-3 mb-3 d-flex align-items-baseline'>
                                            <div class=" pe-4">
                                                <button class="btn btn-primary btn-lg btn-block checkoutpagebtn"
                                                    type="submit">Login</button>
                                            </div>
                                            <p class="px-5">Or</p>
                                            <div class="pl-5">
                                                <a class="btn btn-primary btn-lg btn-block "
                                                    href="{{ route('user-registration') }}">Register</a>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    <h4 class="mb-1">Billing Address</h4>
                    <form class="needs-validation" action="{{ route('add-checkout-details') }}" method="post">
                        @csrf
                        <input type="hidden" name="totalAmount" value="{{ $finalAmount }}" />
                        <div class="row">
                            <div class="col-md-4 mb-1">
                                <label for="firstName">First name</label>
                                <input type="text" class="form-control" name="firstname" id="firstName" placeholder=""
                                    value="{{ old('firstname') ?? ($userData != '' ? $userData->firstname : '') }}"
                                    required>

                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="lastName">Last name</label>
                                <input type="text" class="form-control" name="lastname" id="lastName" placeholder=""
                                    value="{{ old('lastname') ?? ($userData != '' ? $userData->lastname : '') }}"
                                    required>

                            </div>

                            <div class="col-md-4 mb-1">
                                <label for="lastName">Mobile</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder=""
                                    value="{{ old('mobile') ?? ($userData != '' ? $userData->phone : '') }}" required>

                            </div>


                            <div class="col-md-6 mb-1">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder=""
                                    value="{{ old('username') ?? ($userData != '' ? $userData->name : '') }}">

                            </div>

                            <div class="col-md-6 mb-1">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder=""
                                    value="{{ old('email') ?? ($userData != '' ? $userData->email : '') }}">

                            </div>
                        </div>



                        <div class="mb-1">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder=""
                                value="{{ old('address') ?? ($userData != '' ? $userData->address : '') }}" required>

                        </div>

                        <div class="mb-1">
                            <label for="address2">Address 2</label>
                            <input type="text" class="form-control" id="address2" name="address2" placeholder=""
                                value="{{ old('address2') ?? ($userData != '' ? $userData->address2 : '') }}">
                        </div>

                        <div class="row">
                            <div class="col-md-5 mb-1">
                                <label for="country">Country</label>
                                <select class="custom-select d-block w-100" name="country" id="country" required>

                                    <option value="India">
                                        India</option>
                                </select>

                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="state">State</label>
                                <select class="custom-select d-block w-100" name="state" id="state" required>

                                    <option value="Gujarat">
                                        Gujarat</option>
                                    <option value="Rajasthan">
                                        Rajasthan</option>
                                    <option value="Maharastra">
                                        Maharastra</option>
                                </select>

                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" id="zip" name="zip" placeholder=""
                                    value="{{ old('zip') ?? ($userData != '' ? $userData->zip : '') }}" required>

                            </div>
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="differentShipping" value="yes"
                                class="custom-control-input shippingInfo" id="same-address">
                            <label class="custom-control-label " for="same-address">Different Shipping Address</label>
                        </div>

                        <hr class="mb-4">

                        <div class="shippingSection" style="display:none;">
                            <h4 class="mb-1">Shipping Address</h4>

                            <div class="row">
                                <div class="col-md-4 mb-1">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control" name="s_firstname" id="firstName"
                                        placeholder="">

                                </div>
                                <div class="col-md-4 mb-1">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control" name="s_lastname" id="lastName"
                                        placeholder="">

                                </div>

                                <div class="col-md-4 mb-1">
                                    <label for="lastName">Mobile</label>
                                    <input type="text" class="form-control" name="s_mobile" id="mobile"
                                        placeholder="">

                                </div>


                                <div class="col-md-6 mb-1">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="s_username" name="s_username"
                                        placeholder="">

                                </div>

                                <div class="col-md-6 mb-1">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="s_email" name="s_email"
                                        placeholder="">

                                </div>


                                <div class="col-md-12 mb-1">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="s_address" name="s_address1"
                                        placeholder="">

                                </div>


                                <div class="col-md-12 mb-1">
                                    <label for="address2">Address 2</label>
                                    <input type="text" class="form-control" id="s_address2" name="s_address2"
                                        placeholder="">

                                </div>

                                <div class="col-md-4 mb-1">
                                    <label for="country">Country</label>
                                    <select class="custom-select d-block w-100" name="s_country" id="country">

                                        <option value="India">India</option>
                                    </select>

                                </div>

                                <div class="col-md-4 mb-1">
                                    <label for="state">State</label>
                                    <select class="custom-select d-block w-100" name="s_state" id="state">

                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Maharastra">Maharastra</option>
                                    </select>

                                </div>

                                <div class="col-md-4 mb-1">
                                    <label for="zip">Zip</label>
                                    <input type="text" class="form-control" id="s_zip" name="s_zip"
                                        placeholder="">
                                </div>
                            </div>
                        </div>


                        <h4 class="mb-1">Payment</h4>

                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="credit" name="paymentMethod" type="radio" value="online"
                                    class="custom-control-input paymentType" required>
                                <label class="custom-control-label" for="credit">Online</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="debit" name="paymentMethod" type="radio" value="cash"
                                    class="custom-control-input paymentType" checked required>
                                <label class="custom-control-label" for="debit">Cash on Delivery</label>
                            </div>

                        </div>
                        {{-- <div class="row onlineSection" style="display:none;">
                            <div class="col-md-6 mb-1">
                                <label for="cc-name">Name On Card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="">
                                <small class="text-muted">Full Name As Displayed On Card</small>
                                <div class="invalid-feedback">
                                    Name On Card Is Required
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="cc-number">Credit Card Number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="">
                                <div class="invalid-feedback">
                                    Credit Card Number Is Required
                                </div>
                            </div>


                            <div class="col-md-3 mb-1">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="">
                                <div class="invalid-feedback">
                                    Expiration Date Required
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="cc-expiration">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="">
                                <div class="invalid-feedback">
                                    Security Code Required
                                </div>
                            </div>

                        </div> --}}
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block checkoutpagebtn" type="submit">Continue To
                            Checkout</button>
                    </form>
                </div>
            </div>
            {{-- <div class="card card-default">
                <div class="card-header">
                    Laravel - Razorpay Payment Gateway Integration
                </div>
                <div class="card-body text-center">
                    <form action="{{ route('razorpay.payment.store') }}" method="POST">
                        @csrf
                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}"
                            data-amount="{{ $totalAmount * 100 }}" data-buttontext="Pay {{ $totalAmount }} INR" data-name="KM animal"
                            data-description="Razorpay payment" data-image="/images/logo-icon.png" data-prefill.name="ABC"
                            data-prefill.email="abc@gmail.com" data-theme.color="#ff7529"></script>
                    </form>
                </div>
            </div> --}}
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".logintype").click(function() {
                $value = $(this).val();

                if ($value == "Yes") {
                    $(".loginSection").show();
                } else {
                    $(".loginSection").hide();
                }
            });


            $(".paymentType").click(function() {
                $paymentMethod = $(this).val();
                if ($paymentMethod == "online") {
                    $(".onlineSection").show();
                } else {
                    $(".onlineSection").hide();
                }


            });


            $(".shippingInfo").on("click", function() {
                if ($(this).is(":checked")) {
                    $(".shippingSection").show();
                } else {
                    $(".shippingSection").hide();
                }
            });
        });
    </script>
@endsection

<style>
    .loginSection {
        margin: 0;
        padding: 0;
    }
</style>
