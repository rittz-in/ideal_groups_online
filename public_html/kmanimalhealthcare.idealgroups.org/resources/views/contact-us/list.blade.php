@extends('layouts.guest')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    
		<!-- Page Header Section Start Here -->
		<section class="page-header bg_img padding-tb">
			<div class="overlay"></div>
			<div class="container">
				<div class="page-header-content-area">
					<h4 class="ph-title">Contact us</h4>
					<ul class="lab-ul">
						<li><a href="index.html">Home</a></li>
						<li><a class="active">Contact us</a></li>
					</ul>
				</div>
			</div>
		</section>
		<!-- Page Header Section Ending Here -->

		<!-- Contact Us Section Start Here -->
		<div class="contact-section padding-tb50">
			<div class="container">
				<div class="contac-top">
					<div class="row justify-content-center">
						<div class="col-xl-4 col-lg-6 col-12">
							<div class="contact-item">
								<div class="contact-icon">
									<i class="icofont-google-map"></i>
								</div>
								<div class="contact-details">
									<p>5, dheya residency duplex, nr. Shivam flat, pramukh Prasad crossover, manjalpur, vadodara</p>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-12">
							<div class="contact-item">
								<div class="contact-icon">
									<i class="icofont-phone"></i>
								</div>
								<div class="contact-details">
									<p>+91-83208-64968/<br/>+91 94263 14818</p>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-12">
							<div class="contact-item">
								<div class="contact-icon">
									<i class="icofont-envelope"></i>
								</div>
								<div class="contact-details">
									<p>kmanimalhealthcare@gmail.com</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="contac-bottom">
					<div class="row justify-content-center">
						<div class="col-lg-6 col-12">
							<div class="location-map">
								<div id="map">
									<iframe
										src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2171.6233168549234!2d90.38618271679425!3d23.739514243490834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b85c71927841%3A0xde102c300beb3f0c!2sWebCode%20Institute!5e0!3m2!1sen!2sbd!4v1605551468163!5m2!1sen!2sbd"
										allowfullscreen=""></iframe>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="contact-form">
								<form action="#" method="POST" id="commentform" class="comment-form">
									<input type="text" name="name" class="" placeholder="Name*">
									<input type="email" name="email" class="" placeholder="Email*">
									<input type="text" name="subject" class="" placeholder="Subject*">
									<textarea name="text" id="role" cols="30" rows="9" placeholder="Message*"></textarea>
									<button type="submit" class="lab-btn">
										<span>Submit Now</span>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<section class="product-section relative padding-tb bg-ash">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-header">
							<h3>KM Animal HealthCare Products</h3>
							
						</div>
					</div>
					@include('about-us.productAbout')
				</div>
			</div>
		</section>
		

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
@endsection
