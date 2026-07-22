<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#2196f3">
	<meta name="author" content="DexignZone"> 
    <meta name="keywords" content=""> 
    <meta name="robots" content=""> 
	<meta name="description" content="Foodia - Food Restaurant Mobile App Template ( Bootstrap 5 + PWA )">

	<meta property="og:title" content="Foodia - Food Restaurant Mobile App Template ( Bootstrap 5 + PWA )">
	<meta property="og:description" content="Foodia - Food Restaurant Mobile App Template ( Bootstrap 5 + PWA )">
	<meta property="og:image" content="https://makaanlelo.com/tf_products_007/foodia/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">
	
    <!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    
    <!-- Title -->
	<title>@yield('title')</title>
	
	<!-- PWA Version -->
	<link rel="manifest" href="manifest.json">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css" />
    
    <!-- Stylesheets -->
	<link rel="stylesheet" href="{{ asset('FrontAssets/css/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontAssets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('FrontAssets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('FrontAssets/css/custom.css') }}">
    
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Roboto+Slab:wght@100;300;500;600;800&display=swap" rel="stylesheet">

</head>   
<body class="bg-white">
<div class="page-wraper">

<!-- header -->
@if(!request()->routeIs('product-detail'))
@include('frontend.layouts.header')
@endif

 <!-- Preloader -->
	<div id="preloader">
		<div class="spinner"></div>
	</div>
    <!-- Preloader end-->


    <!-- Sidebar -->
    <div class="sidebar">
		<div class="author-box">
			<div class="dz-media">
				<img src="images/pic5.jpg" alt="author-image">
			</div>
			<div class="dz-info">
				<span>Good Morning</span>
				<h5 class="name">Henry Decosta</h5>
			</div>
		</div>
		<ul class="nav navbar-nav">	
			<li class="nav-label">Main Menu</li>
			<li><a class="nav-link" href="welcome.html">
				<span class="dz-icon">
					<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
					<path d="M13.35 20.13c-.76.69-1.93.69-2.69-.01l-.11-.1C5.3 15.27 1.87 12.16 2 8.28c.06-1.7.93-3.33 2.34-4.29 2.64-1.8 5.9-.96 7.66 1.1 1.76-2.06 5.02-2.91 7.66-1.1 1.41.96 2.28 2.59 2.34 4.29.14 3.88-3.3 6.99-8.55 11.76l-.1.09z"></path></svg>
				</span>
				<span>Welcome</span>
			</a></li>
			<li><a class="nav-link" href="index.html">
				<span class="dz-icon">
					<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
						<path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"></path>
					</svg>
				</span>
				<span>Home</span>
			</a></li>
			<li><a class="nav-link" href="pages.html">
				<span class="dz-icon">
					<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M12.6 18.06c-.36.28-.87.28-1.23 0l-6.15-4.78c-.36-.28-.86-.28-1.22 0-.51.4-.51 1.17 0 1.57l6.76 5.26c.72.56 1.73.56 2.46 0l6.76-5.26c.51-.4.51-1.17 0-1.57l-.01-.01c-.36-.28-.86-.28-1.22 0l-6.15 4.79zm.63-3.02l6.76-5.26c.51-.4.51-1.18 0-1.58l-6.76-5.26c-.72-.56-1.73-.56-2.46 0L4.01 8.21c-.51.4-.51 1.18 0 1.58l6.76 5.26c.72.56 1.74.56 2.46-.01z"></path></svg>
				</span>
				<span>Pages</span>
			</a></li>
			<li><a class="nav-link" href="ui-components.html">
				<span class="dz-icon">
					<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"></path></svg>
				</span>
				<span>Components</span>
			</a></li>
			<li><a class="nav-link" href="notification.html">
				<span class="dz-icon">
					<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M18 16v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.68-1.5-1.51-1.5S10.5 3.17 10.5 4v.68C7.63 5.36 6 7.92 6 11v5l-1.3 1.29c-.63.63-.19 1.71.7 1.71h13.17c.89 0 1.34-1.08.71-1.71L18 16zm-6.01 6c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zM6.77 4.73c.42-.38.43-1.03.03-1.43-.38-.38-1-.39-1.39-.02C3.7 4.84 2.52 6.96 2.14 9.34c-.09.61.38 1.16 1 1.16.48 0 .9-.35.98-.83.3-1.94 1.26-3.67 2.65-4.94zM18.6 3.28c-.4-.37-1.02-.36-1.4.02-.4.4-.38 1.04.03 1.42 1.38 1.27 2.35 3 2.65 4.94.07.48.49.83.98.83.61 0 1.09-.55.99-1.16-.38-2.37-1.55-4.48-3.25-6.05z"></path></svg>
				</span>
				<span>Notification</span>
				<span class="badge badge-circle badge-danger">1</span>
			</a></li>
			<li><a class="nav-link" href="profile.html">
				<span class="dz-icon">
					<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z"></path></svg>
				</span>
				<span>Profile</span>
			</a></li>
			<li><a class="nav-link" href="messages.html">
				<span class="dz-icon">
					<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM7 9h10c.55 0 1 .45 1 1s-.45 1-1 1H7c-.55 0-1-.45-1-1s.45-1 1-1zm6 5H7c-.55 0-1-.45-1-1s.45-1 1-1h6c.55 0 1 .45 1 1s-.45 1-1 1zm4-6H7c-.55 0-1-.45-1-1s.45-1 1-1h10c.55 0 1 .45 1 1s-.45 1-1 1z"></path></svg>
				</span>
				<span>Chat</span>
				<span class="badge badge-circle badge-info">5</span>
			</a></li>
			<li><a class="nav-link" href="onboading.html">
				<span class="dz-icon">
					<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g></g><g><g><path d="M5,5h6c0.55,0,1-0.45,1-1v0c0-0.55-0.45-1-1-1H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h6c0.55,0,1-0.45,1-1v0 c0-0.55-0.45-1-1-1H5V5z"></path><path d="M20.65,11.65l-2.79-2.79C17.54,8.54,17,8.76,17,9.21V11h-7c-0.55,0-1,0.45-1,1v0c0,0.55,0.45,1,1,1h7v1.79 c0,0.45,0.54,0.67,0.85,0.35l2.79-2.79C20.84,12.16,20.84,11.84,20.65,11.65z"></path></g></g></svg>
				</span>
				<span>Logout</span>
			</a></li>
            <li class="nav-label">Settings</li>
            <li class="nav-color" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                <a href="javascript:void(0);" class="nav-link">
                    <span class="dz-icon">                        
                        <svg class="color-plate" xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 0 24 24" width="30px" fill="#000000">
							<path d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9c.83 0 1.5-.67 1.5-1.5 0-.39-.15-.74-.39-1.01-.23-.26-.38-.61-.38-.99 0-.83.67-1.5 1.5-1.5H16c2.76 0 5-2.24 5-5 0-4.42-4.03-8-9-8zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 9 6.5 9 8 9.67 8 10.5 7.33 12 6.5 12zm3-4C8.67 8 8 7.33 8 6.5S8.67 5 9.5 5s1.5.67 1.5 1.5S10.33 8 9.5 8zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 5 14.5 5s1.5.67 1.5 1.5S15.33 8 14.5 8zm3 4c-.83 0-1.5-.67-1.5-1.5S16.67 9 17.5 9s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"></path>
						</svg>
                    </span>					
                    <span>Highlights</span>					
                </a>
            </li>
            <li>
                <div class="mode">
                    <span class="dz-icon">
                        <svg class="dark" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g></g><g><g><g><path d="M11.57,2.3c2.38-0.59,4.68-0.27,6.63,0.64c0.35,0.16,0.41,0.64,0.1,0.86C15.7,5.6,14,8.6,14,12s1.7,6.4,4.3,8.2 c0.32,0.22,0.26,0.7-0.09,0.86C16.93,21.66,15.5,22,14,22c-6.05,0-10.85-5.38-9.87-11.6C4.74,6.48,7.72,3.24,11.57,2.3z"></path></g></g></g>
						</svg>
                    </span>					
                    <span class="text-dark">Dark Mode</span>
                    <div class="custom-switch">
                        <input type="checkbox" class="switch-input theme-btn" id="toggle-dark-menu">
                        <label class="custom-switch-label" for="toggle-dark-menu"></label>
                    </div>
                </div>
            </li>
		</ul>
		<div class="sidebar-bottom">
			<h6 class="name">Foodia - Food Restaurant</h6>
			<p>App Version 1.0</p>
        </div>
    </div>
    <!-- Sidebar End -->


    <!-- Banner -->
	<div class="author-notification">
		<div class="container inner-wrapper">
			<div class="dz-info">
				<!-- <span class="text-dark">Good Morning</span> -->
				<!-- <h3 class="name mb-0">James 👋</h3> -->
			</div>
			<a href="javascript:void(0);" class="position-relative me-2 notify-cart" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom2" aria-controls="offcanvasBottom">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.1776 17.8443C16.6362 17.8428 15.3854 19.0912 15.3839 20.6326C15.3824 22.1739 16.6308 23.4247 18.1722 23.4262C19.7136 23.4277 20.9643 22.1794 20.9658 20.638C20.9658 20.6371 20.9658 20.6362 20.9658 20.6353C20.9644 19.0955 19.7173 17.8473 18.1776 17.8443Z" fill="#2C406E"></path>
                    <path d="M23.1278 4.47973C23.061 4.4668 22.9932 4.46023 22.9251 4.46012H5.93181L5.66267 2.65958C5.49499 1.46381 4.47216 0.574129 3.26466 0.573761H1.07655C0.481978 0.573761 0 1.05574 0 1.65031C0 2.24489 0.481978 2.72686 1.07655 2.72686H3.26734C3.40423 2.72586 3.52008 2.82779 3.53648 2.96373L5.19436 14.3267C5.42166 15.7706 6.66363 16.8358 8.12528 16.8405H19.3241C20.7313 16.8423 21.9454 15.8533 22.2281 14.4747L23.9802 5.74121C24.0931 5.15746 23.7115 4.59269 23.1278 4.47973Z" fill="#2C406E"></path>
                    <path d="M11.3404 20.5158C11.2749 19.0196 10.0401 17.8418 8.54244 17.847C7.0023 17.9092 5.80422 19.2082 5.86645 20.7484C5.92617 22.2262 7.1283 23.4008 8.60704 23.4262H8.67432C10.2142 23.3587 11.4079 22.0557 11.3404 20.5158Z" fill="#2C406E"></path>
                </svg>
				<span class="badge badge-danger counter">0</span>
			</a>	
		</div>
	</div>
    <!-- Banner End -->


@yield('content')


<!-- menubar -->
@if(!request()->routeIs('product-detail'))
 @include('frontend.layouts.menubar')
@endif


	<!-- Theme Color Settings -->
	<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom">
        <div class="offcanvas-body small">
            <ul class="theme-color-settings">
                <li>
                    <input class="filled-in" id="primary_color_8" name="theme_color" type="radio" value="color-primary">
					<label for="primary_color_8"></label>
                    <span>Default</span>
                </li>
                <li>
					<input class="filled-in" id="primary_color_2" name="theme_color" type="radio" value="color-green">
					<label for="primary_color_2"></label>
                    <span>Green</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_3" name="theme_color" type="radio" value="color-blue">
					<label for="primary_color_3"></label>
                    <span>Blue</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_4" name="theme_color" type="radio" value="color-pink">
					<label for="primary_color_4"></label>
                    <span>Pink</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_5" name="theme_color" type="radio" value="color-yellow">
					<label for="primary_color_5"></label>
                    <span>Yellow</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_6" name="theme_color" type="radio" value="color-orange">
					<label for="primary_color_6"></label>
                    <span>Orange</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_7" name="theme_color" type="radio" value="color-purple">
					<label for="primary_color_7"></label>
                    <span>Purple</span>
                </li>
                <li>
					<input class="filled-in" id="primary_color_1" name="theme_color" type="radio" value="color-red">
					<label for="primary_color_1"></label>
                    <span>Red</span>
                </li>
                <li>
					<input class="filled-in" id="primary_color_9" name="theme_color" type="radio" value="color-lightblue">
					<label for="primary_color_9"></label>
                    <span>Lightblue</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_10" name="theme_color" type="radio" value="color-teal">
					<label for="primary_color_10"></label>
                    <span>Teal</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_11" name="theme_color" type="radio" value="color-lime">
					<label for="primary_color_11"></label>
                    <span>Lime</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_12" name="theme_color" type="radio" value="color-deeporange">
					<label for="primary_color_12"></label>
                    <span>Deeporange</span>
                </li>
            </ul>
        </div>
    </div>
	<!-- Theme Color Settings End -->
	<!-- CART -->
	<div class="offcanvas offcanvas-bottom rounded-0" tabindex="-1" id="offcanvasBottom2">
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
			<i class="fa-solid fa-xmark"></i>
		</button>
        <div class="offcanvas-body container fixed">
			<div class="item-list style-2">
                <ul>
                    <!-- Dynamic items will be injected here -->
                </ul>
            </div>
			<div class="view-title">
                <div class="container">
					<ul>
						<!-- <li>
							<a href="javascript:void(0);" class="promo-bx">
								Apply Promotion Code
								<span>2 Promos</span>
							</a>
						</li> -->
						<li>
							<span>Subtotal</span>
							<span>$54.76</span>
						</li>
						<!-- <li>
							<span>TAX (2%)</span>
							<span>-$1.08</span>
						</li> -->
						<li>
							<h5>Total</h5>
							<h5>$53.68</h5>
						</li>
					</ul>
					<a href="payment.html" class="btn btn-primary btn-rounded btn-block flex-1 ms-2">CONFIRM</a>
				</div>
            </div>
        </div>
    </div>
	<!-- CART -->
	
	<!-- PWA Offcanvas -->
	<!-- <div class="offcanvas offcanvas-bottom pwa-offcanvas">
		<div class="container">
			<div class="offcanvas-body small">
				<img class="logo" src="images/icon.png" alt="">
				<h5 class="title">Foodia on Your Home Screen</h5>
				<p class="pwa-text">Install Foodia food restaurant mobile app template to your home screen for easy access, just like any other app</p>
				<a href="javascrpit:void(0);" class="btn btn-sm btn-primary pwa-btn">Add to Home Screen</a>
				<a href="javascrpit:void(0);" class="btn btn-sm pwa-close light btn-secondary ms-2">Maybe later</a>
			</div>
		</div>
	</div> -->
	<!-- <div class="offcanvas-backdrop pwa-backdrop"></div> -->
	<!-- PWA Offcanvas End -->
	
</div>

    <!--**********************************
    Scripts
***********************************-->
<script src="{{ asset('FrontAssets/js/jquery.js') }}"></script>
<script src="{{ asset('FrontAssets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('FrontAssets/js/swiper-bundle.min.js') }}"></script><!-- Swiper -->
<script src="{{ asset('FrontAssets/js/dz.carousel.js') }}"></script><!-- Swiper -->
<script src="{{ asset('FrontAssets/js/jquery.bootstrap-touchspin.min.js') }}"></script><!-- Swiper -->
<script src="{{ asset('FrontAssets/js/settings.js') }}"></script>
<script src="{{ asset('FrontAssets/js/custom.js') }}"></script>
<script src="{{ asset('FrontAssets/js/index.js') }}" defer=""></script>






<script>
    $(".stepper").TouchSpin();

    // Shopping Cart Logic
    let cart = JSON.parse(localStorage.getItem('restaurant_cart')) || [];

    function updateCartUI() {
        const cartList = document.querySelector('#offcanvasBottom2 .item-list ul');
        const subtotalElement = document.querySelector('#offcanvasBottom2 .view-title ul li:nth-child(1) span:nth-child(2)');
        const totalElement = document.querySelector('#offcanvasBottom2 .view-title ul li:nth-child(2) h5:nth-child(2)');
        const badgeCounter = document.querySelector('.notify-cart .counter');
        
        if (!cartList) return;

        cartList.innerHTML = '';
        let subtotal = 0;
        let totalItemsCount = 0;

        if (cart.length === 0) {
            cartList.innerHTML = '<li class="p-4 text-center text-white">Your cart is empty</li>';
        } else {
            cart.forEach((item, index) => {
                const price = parseFloat(item.price) || 0;
                const qty = parseInt(item.quantity) || 0;
                const itemTotal = price * qty;
                
                subtotal += itemTotal;
                totalItemsCount += qty;

                cartList.innerHTML += `
                    <li>
                        <div class="item-content">
                            <div class="item-media media media-60">
                                <img src="${item.image}" alt="${item.name}">
                            </div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <h6 class="item-title text-white">${item.name}</h6>
                                </div>
                                <div class="item-footer d-flex justify-content-between align-items-center">
                                    <div class="qty-control">
                                        <div class="cart-item-stepper">
                                            <button onclick="changeQty(${index}, -1)">-</button>
                                            <span>${qty}</span>
                                            <button onclick="changeQty(${index}, 1)">+</button>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <h6 class="text-secondary mb-0">₹ ${itemTotal.toFixed(2)}</h6>
                                        <button class="btn btn-xs btn-danger p-1" onclick="removeFromCart(${index})" style="line-height:1">
                                            <i class="fa-solid fa-trash-can" style="font-size:12px"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                `;
            });
        }

        if (subtotalElement) subtotalElement.innerText = `₹ ${subtotal.toFixed(2)}`;
        if (totalElement) totalElement.innerText = `₹ ${subtotal.toFixed(2)}`;
        if (badgeCounter) badgeCounter.innerText = totalItemsCount;
        
        localStorage.setItem('restaurant_cart', JSON.stringify(cart));
    }

    window.changeQty = function(index, delta) {
        if (cart[index]) {
            let currentQty = parseInt(cart[index].quantity) || 1;
            currentQty += delta;
            
            if (currentQty < 1) currentQty = 1;
            if (currentQty > 10) currentQty = 10;
            
            cart[index].quantity = currentQty;
            updateCartUI();
        }
    };

    window.addToCart = function(button) {
        const productItem = button.closest('.product-item');
        if (!productItem) return;

        const id = productItem.getAttribute('data-id');
        const name = productItem.getAttribute('data-name');
        const price = parseFloat(productItem.getAttribute('data-price')) || 0;
        const image = productItem.getAttribute('data-image');
        const quantityInput = productItem.querySelector('.product-qty');
        const addQty = parseInt(quantityInput.value) || 1;

        const existingItemIndex = cart.findIndex(item => item.id === id);

        if (existingItemIndex > -1) {
            let existingQty = parseInt(cart[existingItemIndex].quantity) || 0;
            cart[existingItemIndex].quantity = existingQty + addQty;
        } else {
            cart.push({ id, name, price, image, quantity: addQty });
        }

        updateCartUI();
        
        // Open cart offcanvas
        const cartOffcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasBottom2'));
        cartOffcanvas.show();
    };

    window.removeFromCart = function(index) {
        cart.splice(index, 1);
        updateCartUI();
    };

    // Live Search Logic (AJAX)
    let searchTimeout = null;
    let originalHomeTitle = '';
    let originalProductTitle = '';

    document.addEventListener('input', function(e) {
        if (e.target && e.target.id === 'live-search') {
            const searchTerm = e.target.value.trim();
            const productListContainer = document.querySelector('.recent-jobs-list ul');
            const homeTitle = document.getElementById('home-title');
            const productTitle = document.getElementById('product-category-title');
            
            if (!productListContainer) return;

            // Store original titles
            if (homeTitle && !originalHomeTitle) originalHomeTitle = homeTitle.innerText;
            if (productTitle && !originalProductTitle) originalProductTitle = productTitle.innerText;

            const isSearching = searchTerm.length > 0;
            const category = originalProductTitle || '';
            const isHome = !!homeTitle;

            // Update Title
            if (homeTitle) homeTitle.innerText = isSearching ? 'Search Results 🔍' : originalHomeTitle;
            if (productTitle) productTitle.innerText = isSearching ? 'Search Results 🔍' : originalProductTitle;

            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const url = new URL(`{{ route('search-products') }}`, window.location.origin);
                url.searchParams.append('q', searchTerm);
                url.searchParams.append('category', category);
                url.searchParams.append('is_home', isHome);

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        productListContainer.innerHTML = html;
                    })
                    .catch(error => console.error('Error fetching search results:', error));
            }, 300);
        }
    });

    // Initialize Cart UI on load
    document.addEventListener('DOMContentLoaded', function() {
        updateCartUI();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>