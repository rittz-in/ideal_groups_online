@extends('layouts.guest')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('siteassets/css/cart.css') }}">

@section('content')
    <!-- Page Header Section Start Here -->
    <section class="page-header bg_img padding-tb">
        <div class="overlay"></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">Success</h4>
                <ul class="lab-ul">
                    <li><a href="">Home</a></li>
                    <li><a href="#" class="">Checkout</a></li>
                    <li><a class="active">Success</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page Header Section Ending Here -->
    <section class=" bg-gradient-faded-light    ">
        <div class="container">
            <div class="py-5 text-center">



                <div class="row">


                    <div class="col-md-12 success order-md-1">

                        <div class="container">
                            <div class="container text-center">
                                <h1>Thank you.</h1>
                                <p class="lead w-lg-50 mx-auto">Your order has been placed successfully.</p>
                                <p class="w-lg-50 mx-auto">Your order number is <a href="#">{{ $order_number }}</a>.
                                    We will
                                    immediatelly process your and it will be delivered in 2 - 5 business days.</p>
                            </div>
                            {{-- <div class="container">
                            <h2 class="h5 mb-5 text-center">You may also like these products</h2>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="card text-center mb-3">
                                        <div class="py-5 px-4">
                                            <img src="https://www.bootdey.com/image/280x280/6495ED/000000" alt=""
                                                class="img-fluid mb-4" />
                                            <h3 class="fs-6 text-truncate"><a href="#"
                                                    class="stretched-link text-reset">Smartphone 5G Black 12GB RAM+512GB
                                                    NEW</a></h3>
                                            <span class="text-success">$799.00</span> <del class="text-muted">$650.83</del>
                                        </div>
                                        <div
                                            class="bg-danger text-white small position-absolute end-0 top-0 px-2 py-2 lh-1 text-center">
                                            <span class="d-block">10%</span>
                                            <span class="d-block">OFF</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card text-center position-relative mb-3">
                                        <div class="py-5 px-4">
                                            <img src="https://www.bootdey.com/image/280x280/FFB6C1/000000" alt=""
                                                class="img-fluid mb-4" />
                                            <h3 class="fs-6 text-truncate"><a href="#"
                                                    class="stretched-link text-reset">Wireless Headphones with Noise
                                                    Cancellation Tru Bass Bluetooth HiFi</a></h3>
                                            <span class="text-success">$250.00</span> <del class="text-muted">$250</del>
                                        </div>
                                        <div
                                            class="bg-danger text-white small position-absolute end-0 top-0 px-2 py-2 lh-1 text-center">
                                            <span class="d-block">25%</span>
                                            <span class="d-block">OFF</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card text-center mb-3">
                                        <div class="py-5 px-4">
                                            <img src="https://www.bootdey.com/image/280x280/008B8B/000000" alt=""
                                                class="img-fluid mb-4" />
                                            <h3 class="fs-6 text-truncate"><a href="#"
                                                    class="stretched-link text-reset">Smartwatch IP68 Waterproof GPS and
                                                    Bluetooth Support</a></h3>
                                            <span class="text-success">$29.00</span> <del class="text-muted">$14.50</del>
                                        </div>
                                        <div
                                            class="bg-danger text-white small position-absolute end-0 top-0 px-2 py-2 lh-1 text-center">
                                            <span class="d-block">50%</span>
                                            <span class="d-block">OFF</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card text-center mb-3">
                                        <div class="py-5 px-4">
                                            <img src="https://www.bootdey.com/image/280x280/00CED1/000000" alt=""
                                                class="img-fluid mb-4" />
                                            <h3 class="fs-6 text-truncate"><a href="#"
                                                    class="stretched-link text-reset">Men's Running Shoes</a></h3>
                                            <span class="text-success">$110.00</span> <del class="text-muted">$85.23</del>
                                        </div>
                                        <div
                                            class="bg-danger text-white small position-absolute end-0 top-0 px-2 py-2 lh-1 text-center">
                                            <span class="d-block">25%</span>
                                            <span class="d-block">OFF</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            localStorage.removeItem("guest_id");
        });
    </script>
@endsection
<style>
    .success h5 {
        color: #F7942A;
    }
</style>
