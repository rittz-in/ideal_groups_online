<!DOCTYPE html>
<html lang="en">

<head>
    <title> KM | {{ $pagename['page_title'] }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('siteassets/images/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('siteassets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/css/bootstrap.min.css ') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/css/style.css') }}">


</head>

<body>
    {{-- {{ ($slot) }} --}}
    <!-- preloader start here -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- preloader ending here -->


    <!--search area-->
    <div class="search-input">
        <div class="search-close">
            <i class="icofont-close-circled"></i>
        </div>
        <form>
            <input type="text" name="text" placeholder="Search Heare">
            <button class="search-btn" type="submit">
                <i class="icofont-search-2"></i>
            </button>
        </form>
    </div>
    <!-- search area -->

    <!-- Mobile Menu Start Here -->
    <div class="mobile-menu transparent-header">
        <nav class="mobile-header">
            <div class="header-logo">
                <a href=""><img src="{{ asset('siteassets/images/km-healthcare-logo.png') }}"
                        alt="KM HealthCare"></a>
            </div>
            <div class="header-bar">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
        <nav class="mobile-menu">
            <div class="mobile-menu-area">
                <div class="mobile-menu-area-inner">
                    <ul class="lab-ul">
                        <li class="active">
                            <a href="">Home gdgd</a>
                        </li>
                        <li><a href="about-us.php">About Us</a></li>
                        <li>
                            <a href="#">Our Products</a>
                            <ul class="lab-ul">

                                <li><a href="stresso-lite.php">Stresso-Lite</a></li>
                                <li><a href="km-nutonic.php">KM Tonic</a></li>
                                <li><a href="im-grosty.php">Im Grosty</a></li>
                                <li><a href="vit-premix-b.php">The Vit Premix-B</a></li>
                                <li><a href="vit-premix-l.php">The Vit Premix-L</a></li>
                            </ul>
                        </li>
                        <!--<li><a href="#">Gallery</a></li>-->
                        <li><a href="contact-us.php">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- Mobile Menu Ending Here -->

    <!-- desktop menu start here -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-3 col-12">
                        <div class="logo py-2">
                            <a href=""><img src="{{ asset('siteassets/images/km-healthcare-logo.png') }}"
                                    alt="KM HealthCare"></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="ht-left">
                            <ul class="lab-ul d-flex flex-wrap justify-content-end">
                                <!---<li class="d-flex flex-wrap align-items-center">
          <div class="ht-add-thumb mr-2">
           <img src="assets/images/header/01.png" alt="address">
          </div>
          <div class="ht-add-content">
           <span>5, dheya residency duplex,<br/> nr. Shivam flat,<br/> pramukh Prasad crossover, <br/>manjalpur, vadodara</span>

          </div>
         </li>!--->
                                <li class="d-flex flex-wrap align-items-center">
                                    <div class="ht-add-thumb mr-2">
                                        <img src="{{ asset('siteassets/images/header/02.png') }}" alt="email">
                                    </div>
                                    <div class="ht-add-content">
                                        <span>Send Mail </span>
                                        <span class="d-block text-bold">kmanimalhealthcare@gmail.com</span>
                                    </div>
                                </li>
                                <li class="d-flex flex-wrap align-items-center">
                                    <div class="ht-add-thumb mr-2">
                                        <img src="{{ asset('siteassets/images/header/03.png') }}" alt="call">
                                    </div>
                                    <div class="ht-add-content">
                                        <span>Make Call </span>
                                        <span class="d-block text-bold">+91-83208-64968/<br />+91 94263 14818</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom bg-theme">
            <div class="header-area">
                <div class="container">
                    <div class="primary-menu">
                        <div class="main-area w-100">
                            <div class="main-menu d-flex flex-wrap align-items-center justify-content-between w-100">
                                <div class="logo">
                                    <a href=""><img
                                            src="{{ asset('siteassets/images/km-healthcare-logo-white.png') }}"
                                            alt="KM HealthCare"></a>
                                </div>
                                <ul class="lab-ul">
                                    <li class="active">
                                        <a href="{{ route('site') }}">Home</a>
                                    </li>
                                    <li><a href="{{ route('aboutus.index') }}">About Us</a></li>



                                    <li>
                                        <a href="#">Products</a>
                                        <ul class="lab-ul">

                                            <li><a href="{{ route('categoryProducts', 'km_spices') }}">KM Spices</a>
                                            </li>
                                            <li><a href="{{ route('categoryProducts', 'km_ products') }}">KM
                                                    Products</a></li>

                                            {{-- <li>
                                                <a href="#">Our Products</a>
                                                <ul class="lab-ul sub-sub-menupas">

                                                    <li><a href="{{ route('stresso.index') }}">Stresso-Lite</a></li>
                                                    <li><a href="{{ route('product.kmNutonic') }}">KM Tonic</a></li>
                                                    <li><a href="{{ route('product.imGrosty') }}">Im Grosty</a></li>
                                                    <li><a href="{{ route('product.vit-premix-b') }}">The Vit
                                                            Premix-B</a>
                                                    </li>
                                                    <li><a href="{{ route('product.vit-premix-l') }}">The Vit
                                                            Premix-L</a>
                                                    </li>

                                                </ul>
                                            </li> --}}






                                            {{-- @foreach ($categories as $category)
                                                <li><a
                                                        href="{{ route('categoryProducts', $category->slug_url) }}">{{ $category->name }}</a>
                                                </li>
                                            @endforeach --}}
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="#">KM Products</a>
                                        <ul class="lab-ul">

                                            <li><a href="{{ route('stresso.index') }}">Stresso-Lite</a></li>
                                            <li><a href="{{ route('product.kmNutonic') }}">KM Tonic</a></li>
                                            <li><a href="{{ route('product.imGrosty') }}">Im Grosty</a></li>

                                            <li><a href="{{ route('product.vit-premix-b') }}">The Vit
                                                    Premix-B</a></li>

                                            <li><a href="{{ route('product.vit-premix-l') }}">The Vit
                                                    Premix-L</a></li>
                                        </ul>
                                    </li>


                                    <!--<li><a href="#">Gallery</a></li>-->
                                    <li><a href="{{ route('contactus.index') }}">Contact Us</a></li>

                                    <li style="
    position: absolute;
    right: 0;
"><a href="#"><img
                                                src="{{ asset('siteassets/images/cart.png') }}"
                                                style="width:40px; height: 30px;">
                                            @php
                                                if (!empty($countCartPoducts)) {
                                                    $totalCartProduct = $countCartPoducts;
                                                } else {
                                                    $totalCartProduct = '';
                                                }

                                            @endphp


                                            <span class="totalCartCount">{{ $totalCartProduct }}</span></a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <!-- desktop menu ending here -->
    <!-- footer section start here -->
    <footer>

        <div class="footer-bottom">
            <div class="container">
                <div class="section-wrapper">
                    <p class="text-center">&copy; 2022 <a href="">KM Animal HealthCare</a>.All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer section start here -->

    <!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="icofont-swoosh-up"></i><span class="pluse_1"></span><span
            class="pluse_2"></span></a>
    <!-- scrollToTop ending here -->


    <script src="{{ asset('siteassets/js/jquery.js') }}"></script>
    <script src="{{ asset('siteassets/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('siteassets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('siteassets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('siteassets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('siteassets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('siteassets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('siteassets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('siteassets/js/lightcase.js') }}"></script>
    <script src="{{ asset('siteassets/js/functions.js') }}"></script>

    <script src="{{ asset('siteassets/js/script.js') }}"></script>
</body>

</html>
