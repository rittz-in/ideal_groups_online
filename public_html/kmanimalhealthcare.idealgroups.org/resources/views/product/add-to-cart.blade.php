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
        <div class="container py-3">
            <div class="card shadow-lg border-4">
                <div class="row">
                    <div class="col-md-8 cart">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h4><b>Shopping Cart</b></h4>
                                </div>
                                <div class="col align-self-center text-right text-muted">{{ count($viewCarts) }} items</div>
                            </div>
                        </div>
                        @php
                            $totalPrice = 0;
                            $cartProductIds = [];
                        @endphp
                        @foreach ($viewCarts as $viewCart)
                            <div class="row border-top border-bottom">
                                <div class="row main align-items-center">
                                    <div class="col-2"><img class="img-fluid" src="{{ asset($viewCart->productImage) }}">
                                    </div>
                                    <div class="col">
                                        <div class="row text-muted">{{ $viewCart->productName }}</div>
                                        <div class="row">{{ $viewCart->variantSize }}</div>
                                    </div>
                                    <div class="col">
                                        {{-- <a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a> --}}
                                        {{-- <input type="number" class="quntity" id="quntity"
                                            value="{{ $viewCart->quntity }}"> --}}


                                        <div class="number">
                                            <span class="minus" id="{{ $viewCart->id }}"
                                                data-amount="{{ $viewCart->amount }}" data-name="minus">-</span>
                                            <input type="number" class="quntity" value="{{ $viewCart->quntity }}"
                                                min="1" readonly />
                                            <span class="plus" id="{{ $viewCart->id }}"
                                                data-amount="{{ $viewCart->amount }}" data-name="plus">+</span>
                                        </div>




                                    </div>
                                    <div class="col">₹
                                        <span
                                            class="getTotalAmount finalAmount-{{ $viewCart->id }}">{{ $viewCart->quntity * $viewCart->amount }}</span>

                                        <a href="{{ route('app-remove-cart-product', $viewCart->id) }}" class="close"
                                            onclick="return deleteConfirm();"> &#10005;</a>


                                    </div>

                                </div>
                            </div>
                            @php
                                $totalPrice += $viewCart->quntity * $viewCart->amount;
                                $cartProductIds[] = $viewCart->product_id;
                            @endphp
                        @endforeach

                        @php
                            $uniqueCartProductIds = array_unique($cartProductIds);
                            $implodeProductId = implode(',', $uniqueCartProductIds);
                        @endphp

                        <input type="hidden" id="cartProductIds" value="{{ $implodeProductId }}" />

                    </div>
                    <div class="col-md-4 summary">
                        <div>
                            <h5><b>Summary</b></h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">ITEMS {{ count($viewCarts) }}</div>
                            <div class="col text-right">₹<span class="itemPrice">{{ $totalPrice }}</span></div>
                        </div>


                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div class="col">Coupon Code <p class="couponMessage" style="color:red">
                                <p>
                            </div>
                            <div class="col text-right"><span class="couponCodePrice" style="color:red">₹0</span>
                            </div>
                        </div>




                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div class="col">TOTAL PRICE</div>
                            <div class="col text-right">₹<span class="itemTotalPrice">{{ $totalPrice }}</span>
                            </div>
                        </div>

                        <input type="hidden" class="cartAmountValues" value="{{ $totalPrice }}" />



                        <h6>COUPON CODE</h6>
                        <input type="text" id="code" placeholder="Enter your code">
                        <p id="validation" style="color:red"></p>
                        <button type="button" id="redeemCoupon" class="redeemCoupon btn btn-primary">Redeem</button>


                        {{-- <button class="btn">CHECKOUT</button> --}}
                        <a href="{{ route('product.checkout') }}" class="btn">CHECKOUT</a>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>
        function deleteConfirm($id) {
            if (confirm("Are you sure to delete Product?")) {

                return true;
            }
            return false;
        }





        $(document).ready(function() {

            /*--------------------- Quntity UP down -------------------*/

            $(".plus,.minus").click(function() {

                var cartType = $(this).data('name');
                var cartId = $(this).attr("id");
                var $quantityInput = $(this).siblings('.quntity');

                if (cartType == "minus") {
                    if ($quantityInput == 1) {
                        var quntity = parseInt($quantityInput.val());
                    } else {
                        var quntity = parseInt($quantityInput.val()) - 1;
                    }
                } else {
                    var quntity = parseInt($quantityInput.val()) + 1;
                }

                var amount = $(this).data('amount');

                $.ajax({
                    url: '{{ route('app-update-tempcart-details', ['cartId' => 'cartId', 'quntity' => 'quntity', 'amount' => 'amount']) }}'
                        .replace('cartId', cartId)
                        .replace('quntity', quntity)
                        .replace('amount', amount),

                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            var TotalAmount = response.TotalAmount;

                            $(".finalAmount-" + cartId).html(TotalAmount);

                        }

                        var getTotalAmount = 0;
                        $('.getTotalAmount').each(function() {
                            var amount = parseInt($(this).text());
                            getTotalAmount += amount;
                        });

                        $(".itemPrice").html(getTotalAmount);
                        $(".itemTotalPrice").html(getTotalAmount);
                        $(".cartAmountValues").val(getTotalAmount);



                    },
                    error: function(error) {
                        console.error('Error fetching records:', error);
                    }
                });



            });


            /*------------------Coupon code functionality -----------*/

            $(".redeemCoupon").click(function() {
                var couponCode = $("#code").val();
                var cartProductIds = $("#cartProductIds").val();
                var cartAmountValues = $(".cartAmountValues").val();

                if (couponCode == "") {
                    $("#validation").html("Please Enter Coupon Code");
                } else {

                    $.ajax({
                        url: '{{ route('app-couponcode-details', ['couponCode' => 'couponCode', 'cartProductIds' => 'cartProductIds', 'cartAmountValues' => 'cartAmountValues']) }}'
                            .replace('couponCode', couponCode)
                            .replace('cartProductIds', cartProductIds)
                            .replace('cartAmountValues', cartAmountValues),

                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $("#validation").html('');

                                var message = response.message;
                                $(".couponMessage").html(message);

                                var CartItemTotalPrice = $(".cartAmountValues").val();

                                if (response.TotalAmount) {
                                    var DiscountAmount = response.TotalAmount;
                                    $(".couponCodePrice").html('-₹' + DiscountAmount);


                                    var ApplyCoupon = CartItemTotalPrice - DiscountAmount;
                                    $(".itemTotalPrice").html(ApplyCoupon);

                                }

                                //$(".finalAmount-" + cartId).html(TotalAmount);

                            } else {
                                $("#validation").html(response.message);
                            }


                        },
                        error: function(error) {
                            console.error('Error fetching records:', error);
                        }
                    });

                }

            });





        });
    </script>





    <script>
        $(document).ready(function() {
            $('.minus').click(function() {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('.plus').click(function() {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
        });
    </script>
@endsection
