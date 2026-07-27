@extends('layouts.guest')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <section class="page-header bg_img padding-tb">
        <div class="overlay"></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">The Vit Premix-L</h4>
                <ul class="lab-ul">
                    <li><a href="">Home</a></li>
                    <li><a href="#" class="">Products</a></li>
                    <li><a class="active">The Vit Premix-L</a></li>
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
                    <h4 class="titleSlogan text-center">"A multivitamin mixture of feed concentrate for layers"</h4>
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
                                                        <img src="{{ asset('siteassets/images/products/the-vit-premix-l.png') }}"
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
                                                        <img src="{{ asset('siteassets/images/products/the-vit-premix-l.png') }}"
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
                                    <h4>The Vit Premix - L</h4>
                                    <p>
                                        Classical deficiency signs and non specific parameters (for example, lowered
                                        production and reproduction rates) are associated with vitamin deficiencies or
                                        excesses. Vitamin nutrition should no longer be considered important only for
                                        preventing deficiency signs but also for optimising animal health, productivity and
                                        product quality. Vitamin dietary intake and utilisation is influenced by many
                                        factors, including particular feed ingredients, bioavailability, harvesting,
                                        processing, storage, feed intake, antagonists, least cost feed formulations and
                                        other factors. Optimum concentrations of vitamins in poultry diets allow today’s
                                        poultry to perform to their genetic potential. Therefore, this mixture provides
                                        multi-vitamin blend to offer your chickens.</p>

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
                                            <td colspan="2" class="text-center"><strong>Each 1 kg contains:-</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin A </td>
                                            <td>12,500,000 IU</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin D3</td>
                                            <td>2,500,000 IU</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin B1 </td>
                                            <td>1500mg</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin B2</td>
                                            <td>5000mg</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin B6</td>
                                            <td>2000mg</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin B12</td>
                                            <td>20mg</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin E</td>
                                            <td>8000mg</td>
                                        </tr>
                                        <tr>
                                            <td>Vitamin K3 </td>
                                            <td>1500mg</td>
                                        </tr>
                                        <tr>
                                            <td>Niachin</td>
                                            <td>100,000mg</td>
                                        </tr>
                                        <tr>
                                            <td>Folic Acid</td>
                                            <td>800mg</td>
                                        </tr>
                                        <tr>
                                            <td>Biotin</td>
                                            <td>6000mcg</td>
                                        </tr>
                                        <tr>
                                            <td>CDP</td>
                                            <td>8000mg</td>
                                        </tr>
                                        <tr>
                                            <td>Niacin</td>
                                            <td>10000mg</td>
                                        </tr>
                                        <tr>
                                            <td>In a base carrying other nutrients like Yeast, etc.</td>
                                            <td>Q.S</td>
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
                                                class="icofont-tick-boxed mr-2 color-theme"></i> Improves egg production
                                        </li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i> Lower weak shell egg</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Improves feed conversion
                                            ratio</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Helps in heat tolerance</li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Maintain immunity of birds
                                        </li>
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Longer production life</li>
                                    </ul>
                                </div>
                                <div class="benifitSection padding-tb20">
                                    <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}">
                                        Mixing
                                        Ratio</h4>
                                    <ul class="lab-ul list-group">
                                        <li class="list-group-item py-1 px-0 border-none"><i
                                                class="icofont-tick-boxed mr-2 color-theme"></i>Layers: 250gms per tonne of
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
