@extends('layouts.guest')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <!-- Page Header Section Start Here -->
    <section class="page-header bg_img padding-tb">
        <div class="overlay"></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">Stresso-Lite</h4>
                <ul class="lab-ul">
                    <li><a href="">Home</a></li>
                    <li><a href="#" class="">Products</a></li>
                    <li><a class="active">Stresso-Lite</a></li>
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
                    <h4 class="titleSlogan text-center">"Stresso - Lite acts as a quick stress reliever and boosts rapid
                        growth"</h4>
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
                                                        <img src="{{ asset('siteassets/images/products/stresso-lite.png') }}"
                                                            alt="The Vit Premix - B">
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
                                                    <div class="sophop-thumb">
                                                        <img src="{{ asset('siteassets/images/products/stresso-lite.png') }}"
                                                            alt="Stresso-Lite">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="post-content">
                                    <h4>Stresso-Lite</h4>
                                    <p>
                                        Ambient temperature and relative humidity are two of the most important
                                        environmental factors for animal productivity and welfare. Despite modern cooling
                                        systems and strategies, animal experience stress of temperature, production and
                                        growth, passes serious health concern and production losses. When animals are
                                        exposed to temperatures that are higher than the comfort zone (16-25°C), they will
                                        experience heat stress. This causes unevenness in antioxidant status and an increase
                                        in oxidative stress. It disturbs the cellular function and has a harmful effect on
                                        the animal’s health and welfare, resulting in huge economic losses.
                                    </p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('app-product-details', 'stresso-lite') }}"
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
                        <p>Very few animals live in an environment that does not change in time and space. For most, day
                            turns to night, seasons come and go, and habitats differ from one place to the next. Such
                            changes are largely predictable. Animals are generally well adapted to deal with this kind of
                            environmental variation, having evolved biological rhythms and movement patterns that maximise
                            their success in passing on their genes to the next generation
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="benifitSection padding-tb20">
                                    <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}">
                                        Challenges</h4>
                                    <p>Other kinds of environmental change are less predictable—the weather and food
                                        supplies fluctuate, predator and competitor numbers vary, and social pressures
                                        change. Facing unpredictable, and potentially dangerous, episodic change is more
                                        challenging. </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="benifitSection padding-tb20">
                                    <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}">
                                        Solution</h4>
                                    <p>These situations need boosting of animal body defence to maintain productivity with
                                        good welfare.</p>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <img src="{{ asset('siteassets/images/klite-02.png') }}"
                                    style="max-width:500px;margin:30px 0;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="benifitSection padding-tb20">
                                    <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}">
                                        Benefits</h4>
                                    <ul class="lab-ul list-group">
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i> Enhance immunity. </li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i> Fight stress</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Reduce mortality/ improves
                                            livability.</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Improves growth and egg
                                            production under stressful conditions.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="benifitSection padding-tb20">
                                    <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}">
                                        Our Solution</h4>
                                    <p>Stresso - Lite is handy product available for productivity enhancement with optimum
                                        welfare of animal under condition of heat stress.</p>
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <img src="{{ asset('siteassets/images/klite-03.png') }}" style="margin:30px 0;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="benifitSection padding-tb20">
                                    <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}">
                                        Dosage</h4>
                                    <ul class="lab-ul list-group">
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i> 100 gm sachet in 500 litres
                                            of drinking water </li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i> 200 gm (100 x 2 ) sachets
                                            in 1000 litres of drinking water.</li>

                                    </ul>
                                </div>
                            </div>

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
