@extends('layouts.guest')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <!-- Page Header Section Start Here -->
    <section class="page-header bg_img padding-tb">
        <div class="overlay"></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">The Vit Premix-B</h4>
                <ul class="lab-ul">
                    <li><a href="">Home</a></li>
                    <li><a href="#" class="">Products</a></li>
                    <li><a class="active">The Vit Premix-B</a></li>
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
                    <h4 class="titleSlogan text-center">"A multivitamin mixture provided espescially for broilers and
                        breeders"</h4>
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
                                                        <img src="{{ asset('siteassets/images/products/the-vit-premix-b.png') }}"
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
                                                    <div class="shop-thumb">
                                                        <img src="{{ asset('siteassets/images/products/the-vit-premix-b.png') }}"
                                                            alt="The Vit Premix - B">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="post-content">
                                    <h4>The Vit Premix - B</h4>
                                    <p>
                                        Vitamins are organic compounds present in most feedstuffs in small amounts and
                                        important for normal metabolism. Vitamins are micronutrients that take part in
                                        almost all organic metabolic processes, and are vitally important for achieving good
                                        performance and health. Deficiency of one or more vitamins can lead to multiple
                                        metabolic disorders, resulting in decreased productivity, delayed growth,
                                        reproductive problems and/or decreased immunity. Nutritional factors are known to
                                        improve locomotion problems.
                                    </p>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('app-product-details', 'the-vit-premix-b') }}"
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



                        <div class="row">
                            <div class="col-md-6">
                                <div class="benifitSection padding-tb20">
                                    <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}">
                                        Composition
                                    </h4>
                                    <table class="table table-striped padding-tb50">
                                        <tr>
                                            <td colspan="2" class="text-center"><strong>Each 500 gm contains:-</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin A </td>
                                            <td>30,000,000 IU</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin D3</td>
                                            <td>8,000,000 IU</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin E </td>
                                            <td>100mg</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin K3</td>
                                            <td>6000mg</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin B1</td>
                                            <td>8000mg</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin B2</td>
                                            <td>16000mg</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin B6</td>
                                            <td>12000mg</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin B12 </td>
                                            <td>0.060mg</td>
                                        </tr>
                                        <tr>
                                            <td>Niachin</td>
                                            <td>100,000mg</td>
                                        </tr>
                                        <tr>
                                            <td>CDP</td>
                                            <td>30000mg</td>
                                        </tr>
                                        <tr>
                                            <td>Folic Acid</td>
                                            <td>3000mg</td>
                                        </tr>
                                        <tr>
                                            <td>Biotin</td>
                                            <td>0.3mg</td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="benifitSection padding-tb20">
                                    <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}">
                                        Benefits
                                    </h4>
                                    <ul class="lab-ul list-group">
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i> Improves growth rate</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i> Improves bone strength</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Improves feed conversion
                                            ratio</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i> Improves metabolic profile
                                        </li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Helps to fight heat stress
                                        </li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Maintains immunity</li>
                                    </ul>
                                </div>
                                <div class="benifitSection padding-tb20">
                                    <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}">
                                        Dosage</h4>
                                    <ul class="lab-ul list-group">
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>BROILERS: 500 g/ tonne of
                                            feed</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>BREEDERS: 1 kg / tonne of
                                            feed</li>
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
