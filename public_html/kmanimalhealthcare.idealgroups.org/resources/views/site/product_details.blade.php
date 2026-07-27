@extends('layouts.guest')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('siteassets/css/product_page.css') }}">
<link rel="stylesheet" href="{{ asset('siteassets/css/product_details.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">

@section('content')
    {{-- <section class="page-header  padding-tb"
        style="background-image:url(siteassets/images/banner/bg-images/main_banner.jpg); ">
        <div class=""></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">Our Products</h4>
                <ul class="lab-ul">
                    <li><a href="">Home</a></li>
                    <li><a class="active"><b>Our Products</b></a></li>
                </ul>
            </div>
        </div>
    </section> --}}
    <section class="page-header bg_img padding-tb">
        <div class="overlay"></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">Product Details</h4>
                <ul class="lab-ul">
                    <li><a href="">Home</a></li>
                    <li><a href="#" class="">Products</a></li>
                    <li><a class="active">Product Details</a></li>
                </ul>
            </div>
        </div>
    </section>
    <section style="background-image:url(siteassets/images/banner/bg-images/background.jpg);">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 p-5">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body">
                            <div class="row p-3">
                                <div class="col-md-6">

                                    <div id="imageSlider" class="carousel slide" data-ride="carousel">

                                        <div class="carousel-inner">
                                            <!----  Loop ma active class remove only first slider put active   --->
                                            @if (!empty($productsImages))
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach ($productsImages as $productsImage)
                                                    @php
                                                        $classType = $i == 1 ? 'active' : '';
                                                        $i++;
                                                    @endphp
                                                    <div class="carousel-item {{ $classType }}">
                                                        <img src="{{ asset($productsImage->images) }}" class="d-block w-100"
                                                            alt="Slide 1">
                                                    </div>
                                                @endforeach
                                            @endif

                                            <!-- Add more carousel items as needed -->
                                        </div>
                                        <a class="carousel-control-prev" href="#imageSlider" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#imageSlider" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>






                                <div class="col-md-6 productSection">
                                    <h5>{{ $products->product_name }}</h5>
                                    <h6>&#8377;{{ $productRanges['min_price'] }}
                                        @if ($productRanges['product_type'] != 'Simple')
                                            - &#8377;{{ $productRanges['max_price'] }}
                                        @endif
                                    </h6>
                                    <p>{{ strip_tags($products->short_description) }}
                                    </p>

                                    @if (!empty($varients))
                                        @foreach ($varients as $varient)
                                            <h6>{{ $varient->varient_name }}</h6>


                                            <div class="row">

                                                @foreach ($varients_types as $varients_type)
                                                    @if ($varients_type->varient_id == $varient->id)
                                                        @if ($varients_type->id == $productRanges['variant_sizes'])
                                                            @php
                                                                $classType = 'productSizeActive';
                                                            @endphp
                                                        @else
                                                            @php
                                                                $classType = '';
                                                            @endphp
                                                        @endif
                                                        <div class="col-md-2">
                                                            <button type="button"
                                                                class="btn btn-warning btn-sm btn-block mb-2 variant-button {{ $classType }}"
                                                                data-id ="{{ $varients_type->id }}"
                                                                data-product ="{{ $products->id }}">{{ $varients_type->variant_sizes }}
                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                        @endforeach
                                    @endif

                                    @if (!empty($productRanges))
                                        @if ($productRanges['product_type'] != 'Simple')
                                            <h6 class="mt-3">Price</h6>

                                            <p><span class="discount_price">&#8377;
                                                    {{ $productRanges['discount_price'] }}</span>
                                                <del class="main_price">&#8377;
                                                    {{ $productRanges['min_price'] }}</del>
                                            </p>
                                        @endif
                                    @endif


                                    <div class="col-md-6 mt-2 mb-4 quantity">
                                        <span class="mt-3">Quantity</span>
                                        <button class="minus btn" aria-label="Decrease">&minus;</button>
                                        <input type="number" name="quntity" class="input-box" id="quntity" value="1"
                                            min="1" max="10">
                                        <button class="plus btn" aria-label="Increase">&plus;</button>
                                    </div>


                                    @csrf
                                    <input type="hidden" name="mainProductId" id="mainProductId"
                                        value="{{ $products->id }}" />
                                    <input type="hidden" name="defaultsize" id="defaultsize"
                                        value="{{ $productRanges['variant_sizes'] }}" />


                                    <input type="hidden" name="product_type" id="product_type"
                                        value="{{ $products->product_type }}" />




                                    <div class="row g-0">
                                        <div class="col-3 p-0">
                                            <a class="btn btn-warning addCart btn-block mb-2 text-white"
                                                data-id="add_cart">Add
                                                to Cart

                                            </a>
                                        </div>

                                        <div class="col-3 p-0">
                                            <a class="btn buyNow  btn-danger btn-block mb-2 ml-4" data-id="buy_cart">Buy
                                                Now</a>
                                        </div>
                                    </div>


                                    <div class="row g-0">
                                        <div class="col-3 p-0 viewCartSection" style="display:none;">
                                            <a href="{{ route('app-product-view-tempcart-details') }}"
                                                class="btn btn-success viewCart btn-block mb-2">View Cart (<span
                                                    class="totalCartAdd"></span>)</a>

                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 mb-2 ml-3 longDescription">
                            <h5>Product Description</h5>
                            <p>{{ strip_tags($products->description) }}
                        </div>

                    </div>






                </div>





            </div>
    </section>

    <?php /*
    <section class="container my-3 pt-5">
        <div class="row mt-3 ">
            <div class="col-lg-6 col-md-12">
                @foreach ($productsImages as $index => $productsImage)
                    @if ($index == 0)
                        <img src="{{ asset($productsImage->images) }}" alt=""
                            class="img-fluid w-100 pb-1 rounded-3 " id="big-img">
                        <div class="row img-group mt-3">
                            <div class="sml-img">
                                <img src="{{ asset($productsImage->images) }}" alt="" width="100%"
                                    class="tmb-img rounded-2">
                            </div>
                        @else
                            <div class="sml-img">
                                <img src="{{ asset($productsImage->images) }}" alt="" width="100%"
                                    class="tmb-img rounded-2">
                            </div>
                    @endif
                @endforeach
            </div>

        </div>
        <div class="col-lg-6 col-md-12 mt-5 ps-0 right-col">
            <h3 class="mt-5 ms-5">&#8377;{{ $productRanges['min_price'] }} - &#8377;{{ $productRanges['max_price'] }}
            </h3>
            <h1 class="mt-3 ms-5">{{ $products->product_name }}</h1>
            <p class="mt-5 ms-5">{{ strip_tags($products->short_description) }}</p>

            @if (!empty($varients))
                @foreach ($varients as $varient)
                    <h6 class="mt-5 ms-5">{{ $varient->varient_name }}</h6>
                    {{-- {{ $varient->id }} main
                                            {{ $productRanges['variant_sizes'] }} another --}}

                    <div class="row g-0 ms-5">

                        @foreach ($varients_types as $varients_type)
                            @if ($varients_type->varient_id == $varient->id)
                                @if ($varients_type->id == $productRanges['variant_sizes'])
                                    @php
                                        $classType = 'productSizeActive';
                                    @endphp
                                @else
                                    @php
                                        $classType = '';
                                    @endphp
                                @endif
                                <div class="col">
                                    <button type="button"
                                        class="btn btn-warning btn-sm btn-block mb-2 variant-button {{ $classType }}"
                                        data-id ="{{ $varients_type->id }}"
                                        data-product ="{{ $products->id }}">{{ $varients_type->variant_sizes }}
                                </div>
                            @endif
                        @endforeach

                    </div>
                @endforeach
            @endif
            <div class="dis-flex align-center mt-4 ms-5">

                <h2>&#8377;{{ $productRanges['min_price'] }}</h2>
                <span class="ms-3 mb-2">50%</span>
            </div>
            <h2 class="ms-5">&#8377;{{ $productRanges['discount_price'] }}</h2>
            <div class="product-counter dis-flex ms-5">
                <div class="dis-flex group2 me-3 mt-5">
                    <img onclick="decriment()" src="{{ asset('siteassets/images/product/icon-minus.svg') }}"
                        alt="" id="minus">
                    <div class="count">1</div>
                    <img onclick="incriment()" src="{{ asset('siteassets/images/product/icon-plus.svg') }}"
                        alt="" id="plus">
                </div>

                <a href="{{ route('product.AddtoCart') }}" onclick="addcart()" class="add-to-cart dis-flex group1 mt-5">
                    <img src="{{ asset('siteassets/images/product/icon-cart.svg') }}" alt="">
                    <h2 class="text-uppercase mt-2">add to cart</h2>
                </a>

            </div>
        </div>
        </div>
    </section>
    <div class="cart-projection none" id="cart">
        <h2>cart</h2>
        <hr>
        <h3 class="text empty">Empty</h3>
        <div class="cart-second-row dis-flex none">
            <div><img src="{{ asset('siteassets/images/product/image-product-1-thumbnail.jpg') }}" alt=""
                    class="cart-img"></div>
            <div>
                <p>Fall Limited Edition Sneakers</p>
                <h3>$125.00 X <span id="num">1</span><span id="total"> $375</span></h3>
            </div>
            <div><img onclick="deltcart()" src="{{ asset('siteassets/images/product/icon-delete.svg') }}"
                    alt=""></div>
        </div>
        <button class="cart-btn">Checkout</button>
    </div>
    <div class="attribution">
        Challenge by <a href="https://www.frontendmentor.io?ref=challenge" target="_blank">Frontend Mentor</a>.
        Coded by <a href="#">Nimesh</a>.
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript.js"></script>
*/
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>
        (function() {
            const quantityContainer = document.querySelector(".quantity");
            const minusBtn = quantityContainer.querySelector(".minus");
            const plusBtn = quantityContainer.querySelector(".plus");
            const inputBox = quantityContainer.querySelector(".input-box");

            updateButtonStates();

            quantityContainer.addEventListener("click", handleButtonClick);
            inputBox.addEventListener("input", handleQuantityChange);

            function updateButtonStates() {
                const value = parseInt(inputBox.value);
                minusBtn.disabled = value <= 1;
                plusBtn.disabled = value >= parseInt(inputBox.max);
            }

            function handleButtonClick(event) {
                if (event.target.classList.contains("minus")) {
                    decreaseValue();
                } else if (event.target.classList.contains("plus")) {
                    increaseValue();
                }
            }

            function decreaseValue() {
                let value = parseInt(inputBox.value);
                value = isNaN(value) ? 1 : Math.max(value - 1, 1);
                inputBox.value = value;
                updateButtonStates();
                handleQuantityChange();
            }

            function increaseValue() {
                let value = parseInt(inputBox.value);
                value = isNaN(value) ? 1 : Math.min(value + 1, parseInt(inputBox.max));
                inputBox.value = value;
                updateButtonStates();
                handleQuantityChange();
            }

            function handleQuantityChange() {
                let value = parseInt(inputBox.value);
                value = isNaN(value) ? 1 : value;

                // Execute your code here based on the updated quantity value
                console.log("Quantity changed:", value);
            }
        })();


        $(document).ready(function() {
            $(".variant-button").click(function() {
                $(".variant-button").removeClass('productSizeActive');
                $(this).addClass('productSizeActive');

                var sizeId = $(this).data('id');
                var productId = $(this).data('product');

                $("#defaultsize").val(sizeId);

                $.ajax({
                    url: '{{ route('app-product-size-price-details', ['sizeId' => 'sizeId', 'productId' => 'productId']) }}'
                        .replace('sizeId', sizeId)
                        .replace('productId', productId),

                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {

                        if (response.success) {
                            var priceData = response.priceData;
                            var price = priceData.price;
                            var discountPrice = priceData.discountPrice;
                            var varientImage = priceData.varientImage;
                            var sliderImages = priceData.sliderImages.images;


                            $(".discount_price").html(discountPrice);
                            $(".main_price").html(price);
                            $(".carousel-inner").html(varientImage);

                            $.each(sliderImages, function(index, image) {
                                $(".carousel-inner").append(
                                    '<div class="carousel-item"><img src="' +
                                    image +
                                    '" class="d-block w-100" alt="Slide"></div>');
                            });

                        }
                    },
                    error: function(error) {
                        console.error('Error fetching records:', error);
                    }
                });



            });

            /*------------- Add To Cart Ajax Call Details ------------*/

            $(".addCart,.buyNow").click(function() {

                var cartType = $(this).data('id');

                var productId = $("#mainProductId").val();
                var quntity = $("#quntity").val();
                var product_type = $("#product_type").val();
                if (product_type == 'Simple') {
                    var varientSize = 'NULL';

                } else {
                    var varientSize = $("#defaultsize").val();
                }



                $.ajax({
                    url: '{{ route('app-product-add-tempcart-details', ['productId' => 'productId', 'quntity' => 'quntity', 'varientSize' => 'varientSize']) }}'
                        .replace('productId', productId)
                        .replace('quntity', quntity)
                        .replace('varientSize', varientSize),
                    type: "GET",
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            if (cartType == "add_cart") {
                                var TotalCart = response.TotalCart;
                                $(".viewCartSection").show();
                                $(".totalCartAdd").html(TotalCart);
                                $(".totalCartCount").html(TotalCart);
                            } else {
                                window.location.href =
                                    '{{ route('app-product-view-tempcart-details') }}';
                            }
                        }


                    }
                });

            });
        });
    </script>

    {{-- <style>
        .productSection h6 {
            color: #F7942A;
        }

        .productSection p {
            margin-bottom: 2%;
            text-align: justify;
        }

        .addCart,
        .buyNow {
            cursor: pointer;
        }

        .productSizeActive,
        .productSizeActive:hover,
        .productSizeActive:active {
            background-color: #b9a159;
            border: 1px solid #b9a159 !important;
            color: #240b0b;
            font-weight: bold;
        }


        .discount_price {
            color: #008000;
            margin-right: 10px;
        }

        .main_price {
            color: #ff0000;
        }

        .longDescription p {
            text-align: justify;
            padding: 0px 40px 0px 0px;
        }

        .buyNow {
            background-color: #FFA41C;
            border: 1px solid #FFA41C;
        }

        .buyNow:hover {
            background-color: #ffa41cc9;
            border: 1px solid #ffa41cc9;
        }



        .quantity {
            /* display: flex;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            border: 2px solid #3498db;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            border-radius: 4px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            overflow: hidden;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
            margin: 0;
            padding: 0;
        }

        .quantity span {
            color: #F7942A;
            font-weight: bold;
            margin-right: 5%;
            font-size: 20px;
        }

        .quantity button {
            background-color: #F7942A;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 20px;
            width: 30px;
            height: auto;
            text-align: center;
            transition: background-color 0.2s;
        }

        .quantity button:hover {
            background-color: #F7942A;
        }

        .input-box {
            width: 40px;
            text-align: center;
            border: none;
            padding: 8px 10px;
            font-size: 16px;
            outline: none;
        }

        /* Hide the number input spin buttons */
        .input-box::-webkit-inner-spin-button,
        .input-box::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .input-box[type="number"] {
            -moz-appearance: textfield;
        }
    </style> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // image slide
        var largImg = document.getElementById('big-img');
        var smlImg = document.getElementsByClassName('tmb-img');

        smlImg[0].onclick = function() {
            largImg.src = smlImg[0].src;
        }
        smlImg[1].onclick = function() {
            largImg.src = smlImg[1].src;
        }
        smlImg[2].onclick = function() {
            largImg.src = smlImg[2].src;
        }
        smlImg[3].onclick = function() {
            largImg.src = smlImg[3].src;
        }

        // cart Qty count
        var minus = document.getElementById('minus');
        var plus = document.getElementById('plus');
        var initialCount = document.querySelector('.count');
        var num = document.querySelector('#num');
        var totalAmount = document.querySelector("#total");
        var count = 1;

        function incriment() {
            count++;
            initialCount.innerHTML = count;
            num.innerHTML = count + "=";
            totalAmount.innerHTML = count * 120;
        }

        function decriment() {
            count--;
            initialCount.innerHTML = count;
            num.innerHTML = count + "=";
            totalAmount.innerHTML = count * 120;
        }
        // mobile nav menu

        var menuSlide = document.querySelector('#mob-nav-items')

        function menuBar() {
            menuSlide.classList.toggle('none')
        }

        // cart toggle menu
        var drop = document.querySelector('#cart');

        function toggleManu() {
            drop.classList.toggle('none')

        }
        // navbar currection
        var navbar = document.querySelector('#menu');

        function rmvMenu() {
            drop.classList.add('none')
        }

        // add items to cart

        var addCart = document.querySelector('.cart-second-row');
        var empty = document.querySelector('.text');

        function addcart() {
            addCart.classList.remove('none')
            empty.classList.add('none')
        }

        // cart delete

        function deltcart() {
            addCart.classList.add('none')
            empty.classList.remove('none')
        }
    </script>
@endsection
