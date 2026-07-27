@extends('layouts.guest')
@section('content')
    <!-- Banner Section Start Here -->
    <section class="banner">
        <div class="banner-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="banner-slider-part"
                        style="background-image: url('{{ asset('siteassets/images/slider/slider03.jpg') }}');">

                        <div class="container">
                            <div class="row flex-row-reverse justify-content-center align-items-center">
                                <div class="col-12">
                                    <div class="banner-content">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="banner-slider-part"
                        style="background-image: url('{{ asset('siteassets/images/slider/slider01.jpg') }}');">

                        <div class="container">
                            <div class="row flex-row-reverse justify-content-center align-items-center">
                                <div class="col-12">
                                    <div class="banner-content">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="banner-slider-part"
                        style="background-image: url('{{ asset('siteassets/images/slider/slider02.jpg') }}');">

                        <div class="container">
                            <div class="row flex-row-reverse justify-content-center align-items-center">
                                <div class="col-12">
                                    <div class="banner-content">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- Banner Section Ending Here -->

    <!-- about section start here -->
    <section class="about-section relative padding-tb">
        <div class="container">
            <div class="row align-items-center mb-15">
                <div class="col-lg-6 col-12">
                    <div class="about-thumb">
                        <img src="{{ asset('siteassets/images/about-km.jpg') }}" alt="KM Animal HealthCare">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="about-wrapper p-0">
                        <div class="about-title">
                            <h2><span class="d-lg-block"> Welcome to KM Animal HealthCare </span></h2>
                            <p>KM Animal HealthCare is a company want to serve the needs of poultry sector. Working over the
                                need of broiler and layer birds and its economics of the industry.</p>
                            <p>To better serve the poultry fraternity, we would like to thrive poultry sector in the way of
                                innovation. To best suite the requirement and economics of the poultry industry, we work
                                over our products with the innovative and economics ideas in the poultry world.</p>
                            <p>We offer the products that best suit the nutritional need of the chickens and most probably
                                the market demand.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about section ending here -->

    <!-- product category section start here -->
    <section class="product-section relative padding-tb bg-ash">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header">
                        <h3>KM Animal HealthCare Products</h3>

                    </div>
                </div>
                <?php //include('our-products.php');
                ?>
            </div>
        </div>
    </section>
    <!-- product category section ending here -->

    <!-- service section start here -->
    <section class="service-section padding-tb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header">
                        <h3>KM Animal HealthCare Services</h3>

                    </div>
                </div>
                <div class="col-12">
                    <div class="service-content">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="lab-item service-item">
                                    <div class="lab-inner p-4 mb-4 text-left">
                                        <div class="service-top d-flex align-items-center mb-4">
                                            <div class="st-thumb mr-3">
                                                <img src="{{ asset('siteassets/images/service/01.png') }}"
                                                    alt="service image">
                                            </div>
                                            <div class="st-content mt-2">
                                                <a href="#">
                                                    <h6>Alternative egg</h6>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="service-bottom">
                                            <p>Continually aggregate frictionle enthusias generate user friendly vortals
                                                empowered without globally results.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="lab-item service-item">
                                    <div class="lab-inner p-4 mb-4 text-left">
                                        <div class="service-top d-flex align-items-center mb-4">
                                            <div class="st-thumb mr-3">
                                                <img src="{{ asset('siteassets/images/service/02.png') }}"
                                                    alt="service image">
                                            </div>
                                            <div class="st-content mt-2">
                                                <a href="#">
                                                    <h6>Poultry Cages</h6>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="service-bottom">
                                            <p>Continually aggregate frictionle enthusias generate user friendly vortals
                                                empowered without globally results.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="lab-item service-item">
                                    <div class="lab-inner p-4 mb-4 text-left">
                                        <div class="service-top d-flex align-items-center mb-4">
                                            <div class="st-thumb mr-3">
                                                <img src="{{ asset('siteassets/images/service/03.png') }}"
                                                    alt="service image">
                                            </div>
                                            <div class="st-content mt-2">
                                                <a href="#">
                                                    <h6>Breeder Management</h6>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="service-bottom">
                                            <p>Continually aggregate frictionle enthusias generate user friendly vortals
                                                empowered without globally results.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="lab-item service-item">
                                    <div class="lab-inner p-4 mb-4 text-left">
                                        <div class="service-top d-flex align-items-center mb-4">
                                            <div class="st-thumb mr-3">
                                                <img src="{{ asset('siteassets/images/service/04.png') }}"
                                                    alt="service image">
                                            </div>
                                            <div class="st-content mt-2">
                                                <a href="#">
                                                    <h6>Poultry Climate</h6>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="service-bottom">
                                            <p>Continually aggregate frictionle enthusias generate user friendly vortals
                                                empowered without globally results.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="lab-item service-item">
                                    <div class="lab-inner p-4 mb-4 text-left">
                                        <div class="service-top d-flex align-items-center mb-4">
                                            <div class="st-thumb mr-3">
                                                <img src="{{ asset('siteassets/images/service/05.png') }}"
                                                    alt="service image">
                                            </div>
                                            <div class="st-content mt-2">
                                                <a href="#">
                                                    <h6>Residue Teatment</h6>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="service-bottom">
                                            <p>Continually aggregate frictionle enthusias generate user friendly vortals
                                                empowered without globally results.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="lab-item service-item">
                                    <div class="lab-inner p-4 mb-4 text-left">
                                        <div class="service-top d-flex align-items-center mb-4">
                                            <div class="st-thumb mr-3">
                                                <img src="{{ asset('siteassets/images/service/06.png') }}"
                                                    alt="service image">
                                            </div>
                                            <div class="st-content mt-2">
                                                <a href="#">
                                                    <h6>Exhaust air Treatment</h6>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="service-bottom">
                                            <p>Continually aggregate frictionle enthusias generate user friendly vortals
                                                empowered without globally results.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- service section ends here -->

    <!-- Gallery section start here -->
    <section class="gallery-section padding-tb bg-ash">
        <div class="container-fluid p-0 m-0">
            <div class="row">
                <div class="col-12">
                    <div class="section-header">
                        <h3>Poultry Farm Gallery</h3>

                    </div>
                </div>
                <div class="col-12">
                    <div class="gallery-content">
                        <div class="gallery-grid text-center">
                            <a href="{{ asset('siteassets/images/gallery/01.jpg') }}"
                                data-rel="lightcase:myCollection:slideshow" class="grid-image">
                                <img src="{{ asset('siteassets/images/gallery/01.jpg') }}" alt="gallery-image">
                            </a>
                            <a href="{{ asset('siteassets/images/gallery/02.jpg') }}"
                                data-rel="lightcase:myCollection:slideshow" class="grid-image">
                                <img src="{{ asset('siteassets/images/gallery/02.jpg') }}" alt="gallery-image">
                            </a>
                            <a href="{{ asset('siteassets/images/gallery/03.jpg') }}"
                                data-rel="lightcase:myCollection:slideshow" class="grid-image">
                                <img src="{{ asset('siteassets/images/gallery/03.jpg') }}" alt="gallery-image">
                            </a>
                            <a href="{{ asset('siteassets/images/gallery/04.jpg') }}"
                                data-rel="lightcase:myCollection:slideshow" class="grid-image">
                                <img src="{{ asset('siteassets/images/gallery/04.jpg') }}" alt="gallery-image">
                            </a>
                            <a href="{{ asset('siteassets/images/gallery/05.jpg') }}"
                                data-rel="lightcase:myCollection:slideshow" class="grid-image">
                                <img src="{{ asset('siteassets/images/gallery/05.jpg') }}" alt="gallery-image">
                            </a>
                            <a href="{{ asset('siteassets/images/gallery/06.jpg') }}"
                                data-rel="lightcase:myCollection:slideshow" class="grid-image">
                                <img src="{{ asset('siteassets/images/gallery/06.jpg') }}" alt="gallery-image">
                            </a>
                            <a href="{{ asset('siteassets/images/gallery/07.jpg') }}"
                                data-rel="lightcase:myCollection:slideshow" class="grid-image">
                                <img src="{{ asset('siteassets/images/gallery/07.jpg') }}" alt="gallery-image">
                            </a>
                            <a href="{{ asset('siteassets/images/gallery/08.jpg') }}"
                                data-rel="lightcase:myCollection:slideshow" class="grid-image">
                                <img src="{{ asset('siteassets/images/gallery/08.jpg') }}" alt="gallery-image">
                            </a>
                        </div>
                        <div class="gallery-btn text-center mt-5">
                            <a href="#" class="lab-btn"><span>Load Gallery</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery section ends here -->

    <!-- team section start here -->
    <section class="team-section padding-tb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header">
                        <h3>Our Team Member</h3>
                    </div>
                </div>
                <div class="col-12">
                    <div class="section-wrapper">
                        <div class="row justify-content-center">
                            <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                <div class="card mb-4 text-center border-none">
                                    <img src="{{ asset('siteassets/images/teamphoto.jpg') }}" class="card-img-top"
                                        alt="product">
                                    <div class="card-body">
                                        <a href="#">
                                            <h6 class="card-title mb-0">Madhavi Vispute</h6>
                                        </a>
                                        <p class="card-text mb-2">CEO</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                <div class="card mb-4 text-center border-none">
                                    <img src="{{ asset('siteassets/images/teamphoto.jpg') }}" class="card-img-top"
                                        alt="product">
                                    <div class="card-body">
                                        <a href="#">
                                            <h6 class="card-title mb-0">Rajesh Vispute</h6>
                                        </a>
                                        <p class="card-text mb-2">Director & Marketing</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                <div class="card mb-4 text-center border-none">
                                    <img src="{{ asset('siteassets/images/teamphoto.jpg') }}" class="card-img-top"
                                        alt="product">
                                    <div class="card-body">
                                        <a href="#">
                                            <h6 class="card-title mb-0">Divyani Vispute</h6>
                                        </a>
                                        <p class="card-text mb-2">MD</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                <div class="card mb-4 text-center border-none">
                                    <img src="{{ asset('siteassets/images/teamphoto.jpg') }}" class="card-img-top"
                                        alt="product">
                                    <div class="card-body">
                                        <a href="#">
                                            <h6 class="card-title mb-0">Rajendra Parmar</h6>
                                        </a>
                                        <p class="card-text mb-2">Marketing Manager</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                <div class="card mb-4 text-center border-none">
                                    <img src="{{ asset('siteassets/images/teamphoto.jpg') }}" class="card-img-top"
                                        alt="product">
                                    <div class="card-body">
                                        <a href="#">
                                            <h6 class="card-title mb-0">Solanki Bhupendra R.</h6>
                                        </a>
                                        <p class="card-text mb-2">Area Manager</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                <div class="card mb-4 text-center border-none">
                                    <img src="{{ asset('siteassets/images/teamphoto.jpg') }}" class="card-img-top"
                                        alt="product">
                                    <div class="card-body">
                                        <a href="#">
                                            <h6 class="card-title mb-0">Sanjay Sharma</h6>
                                        </a>
                                        <p class="card-text mb-2">Area Manager</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
