@extends('layouts.guest')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <!-- Page Header Section Start Here -->
    <section class="page-header bg_img padding-tb">
        <div class="overlay"></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">KM Tonic</h4>
                <ul class="lab-ul">
                    <li><a href="">Home</a></li>
                    <li><a href="#" class="">Products</a></li>
                    <li><a class="active">KM Tonic</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page Header Section Ending Here -->

    <!-- Shop Page Section start here -->
    <section class="shop-single padding-tb50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="titleSlogan text-center">"Our product provides various Amino Acids,Protein, minerals and
                        nutrients"</h4>
                </div>
            </div>
            <div class="row justify-content-center mb-15">
                <div class="col-lg-10 col-12 sticky-widget">
                    <div class="product-details">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-12">
                                <div class="product-thumb">
                                    <div class="swiper-container gallery-top">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="shop-item">
                                                    <div class="shop-thumb">
                                                        <img src="{{ asset('siteassets/images/products/km-tonic.png') }}"
                                                            alt="shop-single">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="shop-navigation d-flex flex-wrap">
                                            <div class="shop-nav shop-slider-prev"><i class="icofont-simple-left"></i>
                                            </div>
                                            <div class="shop-nav shop-slider-next"><i class="icofont-simple-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-container gallery-thumbs">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="shop-item">
                                                    <div class="shop-thumb">
                                                        <img src="{{ asset('siteassets/images/products/km-tonic.png') }}"
                                                            alt="shop-single">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="post-content">
                                    <h4>KM Tonic</h4>
                                    <p>
                                        Growth in broilers and egg in layer birds is major production for economic gains of
                                        farmer. Modern broilers and layers produce at full genetic potential but require
                                        optimum nutrients.</p>
                                    <p>Among all the nutrients, protein is important, but also a costly item for production.
                                        Protein is made up of amino acids required for optimum growth and egg production,
                                        because meat contains 15% protein as well as an egg accounts 6-7 grams of protein in
                                        it. There are total 20-22 amino acids out of which essential amino acids are not
                                        synthesized by the body and has to be provided from outside.</p>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('app-product-details', 'km-tonic') }}"
                                                class="btn btn-danger btn-sm btn-block mb-2 BuyNow">Buy
                                                Now</a>
                                        </div>
                                    </div>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="productDetails">
                        <p>These amino acids play an important role in carrying out the metabolic process as well as
                            providing optimum immunity.</p>
                        <p>Along with amino acids vitamins like fat soluble and water soluble also play an important role in
                            growth, body formation, immunity, bone formation, egg shell formation and other vital body
                            formations. Vitamin A play a major role in maintenance of cell line, vitamin D is for bone
                            growth and strength, vitamin E acts as natural anti-oxidant.</p>
                        <p class="text-center"><img style="max-width:350px;"
                                src="{{ asset('siteassets/images/chicken-liver.jpg') }}"></p>
                        <h4 class="text-center">Tricholine Citrate (TCC) <br /><span
                                style="font-size:17px;color:#716c80;">regulate fat utilization and lower fat deposition in
                                liver</span></h4>
                        <p>Whereas water soluble vitamin like Tricholine Citrate regulate fat utilization and lower fat
                            deposition in liver. Vitamin like Biotin also regulate fat in body whereas vitamins like Niacin,
                            Thiamine, Riboflavin, Pantothenic acid are important for body functions and immunity. So, any
                            marginal deficiency of vitamins and amino acids lower growth, egg production, compromised
                            immunity, and higher feed conversion ratio.</p>
                        <p>Feed cannot be devoid of vitamins and amino acids but due to lower intake in heat load, higher
                            growth rate results in derailment of body functions. Supplements of vitamins and amino acids in
                            liquid form enhance absorption at required quantity and improve body function. Oral
                            supplementation advantages are already given below.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="benifitSection padding-tb20">
                                    <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}">
                                        Composition
                                    </h4>
                                    <ul class="lab-ul list-group">
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>All vitamins</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Pantothenic acid</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>All amino acids</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Tricholine Citrate</li>


                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="benifitSection padding-tb20">
                                    <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}">
                                        Benefits
                                    </h4>
                                    <ul class="lab-ul list-group">
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Improves immunity.</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Improves growth and
                                            production.</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Improves feed conversion
                                            ratio.</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Fight stress.</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Reduce mortality. / Increase
                                            livability.</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="benifitSection padding-tb20">
                            <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}"> Dosage</h4>
                            <p><strong>BROILER:</strong></p>
                            <ul class="lab-ul list-group">
                                <li class="list-group-item py-1 px-0 border-none"><i
                                        class="icofont-tick-boxed mr-2 color-theme"></i>(0-3 weeks): 5- 10 ml / 100 birds
                                </li>
                                <li class="list-group-item py-1 px-0 border-none"><i
                                        class="icofont-tick-boxed mr-2 color-theme"></i>(3wks- marketing): 10 – 15 ml / 100
                                    birds</li>
                            </ul>
                            <p><strong>LAYERS:</strong></p>
                            <ul class="lab-ul list-group">
                                <li class="list-group-item py-1 px-0 border-none"><i
                                        class="icofont-tick-boxed mr-2 color-theme"></i>Chicks: 5 – 10 ml / 100 birds</li>
                                <li class="list-group-item py-1 px-0 border-none"><i
                                        class="icofont-tick-boxed mr-2 color-theme"></i>Grower: 10 – 15 ml / 100 birds</li>
                                <li class="list-group-item py-1 px-0 border-none"><i
                                        class="icofont-tick-boxed mr-2 color-theme"></i>Layer: 15 – 25 ml / 100 birds</li>
                            </ul>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </section>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

<style>
    .BuyNow {
        background-color: #088449 !important;
        color: #fff !important;
        border: 1px solid #088449 !important;
    }

    .BuyNow:hover {
        background-color: #088449cf !important;
    }
</style>
