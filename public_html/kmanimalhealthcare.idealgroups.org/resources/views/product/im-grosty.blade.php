@extends('layouts.guest')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <!-- Page Header Section Start Here -->
    <section class="page-header bg_img padding-tb">
        <div class="overlay"></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">Im Grosty</h4>
                <ul class="lab-ul">
                    <li><a href="">Home</a></li>
                    <li><a href="#" class="">Products</a></li>
                    <li><a class="active">Im Grosty</a></li>
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
                    <h4 class="titleSlogan text-center">"A curated herbal product to enhance immunity and help during
                        respiratory distress."</h4>
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
                                                        <img src="{{ asset('siteassets/images/products/grosti.png') }}"
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
                                                        <img src="{{ asset('siteassets/images/products/grosti.png') }}"
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
                                    <h4>Im Grosty</h4>
                                    <p>
                                        Breathing is a fundamental process that allows mammals to oxygenate their blood, but
                                        the respiratory system of a bird is very different from that of humans and other
                                        mammals. A bird has air sacs throughout its body which are extensions of its lungs.
                                        They do not have a muscular diaphragm (like humans) which acts as a bellows, drawing
                                        air in and out.
                                    </p>
                                    <p>The far more complex respiratory system of the chicken ensures it always has fresh
                                        oxygen flowing through it.</p>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('app-product-details', 'im-Grosty') }}"
                                                class="btn btn-danger btn-sm btn-block mb-2 BuyNow">Buy
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="productDetails">
                        <p>This compound respiratory system states that birds are vulnerable to respiratory-related
                            diseases. The common problems are: viruses, bacteria, fungi, parasites, and environment.</p>
                        <p>A very common situation is seen in which one problem is leading another. For example, a bird may
                            catch a viral disease, leaving it vulnerable to bacteria affecting a lung or air sac.</p>
                        <div class="benifitSection padding-tb20">
                            <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}"> Composition
                            </h4>
                            <table class="table table-striped padding-tb50">
                                <tr>
                                    <td><strong>Each 2 litres contains</strong></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><strong>Tinospora cordifolia <br />Adhatoda vasica <br />Curcuma longa</strong></td>
                                    <td><strong>Their benefits are:</strong> fight the respiratory distress. And is helpful
                                        in solving respiratory distress</td>
                                </tr>
                                <tr>
                                    <td><strong>Odium sanctum <br />Emblica officinalis </strong></td>
                                    <td>The above two has a major role in improving immunity</td>
                                </tr>
                                <tr>
                                    <td><strong>Moringa olicfera</strong></td>
                                    <td> provides essential amino acids, minerals and anti-oxidant. Leading majorly to
                                        health improvement.</td>
                                </tr>
                            </table>
                        </div>
                        <div class="benifitSection padding-tb20">
                            <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}"> Dosage</h4>
                            <p><strong>To reduce respiratory distress in broiler</strong></p>
                            <ul class="lab-ul list-group">
                                <li class="list-group-item py-1 px-0 border-none"><i
                                        class="icofont-tick-boxed mr-2 color-theme"></i>After 1st vaccine - 5ml/100 birds-
                                    for 3 days</li>
                                <li class="list-group-item py-1 px-0 border-none"><i
                                        class="icofont-tick-boxed mr-2 color-theme"></i>After 2nd vaccine - 5ml/100 birds-
                                    for 3 days</li>
                                <li class="list-group-item py-1 px-0 border-none"><i
                                        class="icofont-tick-boxed mr-2 color-theme"></i>After 3rd vaccine - 10ml/100 birds –
                                    for 3 days</li>


                            </ul>
                            <p><i>When conditions during respiratory distress/ respiratory infection:-</i></p>
                            <p>Along-with treatment 10 ml/ 100 birds for 3-6 days depending on recovery.</p>
                        </div>
                        <div class="benifitSection padding-tb20">
                            <h4 class="titleWithImage"><img src="{{ asset('siteassets/images/hen-icon.png') }}"> Packaging
                            </h4>

                            <ul class="lab-ul list-group">
                                <li class="list-group-item py-1 px-0 border-none"><i
                                        class="icofont-tick-boxed mr-2 color-theme"></i>2 Litres Bottle</li>
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
