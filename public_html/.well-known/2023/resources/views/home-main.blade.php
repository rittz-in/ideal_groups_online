<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>{{ $username }}</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('assets/Style.css') }}">

<link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

@if($test_user == "")

    <link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Details Not Found') }}
        </div>

        <h2 class="notfound">Please Add Your Details First</h2>
        
    </div>

@else

  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <div> 
         @if ($item->logo)
        <img src="{{ Storage::url($color->logo) }}" class="navbar-brand" alt="Service 6" height="auto">
        @elseif ($item->BrandName)
        {{ $item->BrandName }}
        @else
        {{ $item->username }}
        @endif
    </div>
    <button class="navbar-toggler mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="#ffff" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H20" stroke="#ffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto"> 
            <li class="nav-item">
                <a class="nav-link scrollto" href="#home">Home</a>
            </li>
            @if(isset($data['aboutFront']) && $data['aboutFront']->count() > 0)
            <li class="nav-item">
                <a class="nav-link scrollto" href="#about-us">About</a>
            </li>
            @endif
            @if($data['serviceFronts']->count() > 0)
            <li class="nav-item">
                <a class="nav-link scrollto" href="#services">Service</a>
            </li>
            @endif
            @if($data['videoFront']->count() > 0)
            <li class="nav-item">
                <a class="nav-link scrollto" href="#video_start">Videos</a>
            </li>
            @endif
            @if($data['paymentFront']->count() > 0)
            <li class="nav-item">
                <a class="nav-link scrollto" href="#payment-details">Payment Details</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link scrollto" href="#Inquiry_form">Inquiry</a>
            </li>
            <li class="nav-item">
                <a class="nav-link scrollto" href="#Contact">Contact Details</a>
            </li>

            @if($data['testimonials']->count() > 0)
            <li class="nav-item">
                <a class="nav-link scrollto" href="#Testimonials">Testimonials</a>
            </li>
            @endif
        </ul>
       
      </div>
    </div>
  </nav>

<!--Card Start -->
<div class="container d-flex flex-column align-items-center col-sm-12 mt-5" id="home">
    <div class="text-center" id="main_card_start">
      <div class="row">
        <div class="col" style="background-color: {{ $color->color }};">
          <img class="banner_image" src="{{Storage::URL($color->banner)}}" alt="">
        </div>
      </div>
      <!-- Second Section -->
      <div class="row" style="background: linear-gradient(to bottom, {{ $color->color }} 50%, #fff 50%);">
        <div class="col d-flex justify-content-center align-items-center">
          <img class="round_logo" src="{{Storage::URL($color->logo)}}" alt="" style="background-color: {{ $color->color }};">
        </div>
      </div>
      <!-- Third Section -->
      <div class="row mt-4">
        <div class="col">
          <div class="qwe">
            <h1 style="color: {{ $color->color }};">{{ $color->BrandName }}</h1>
            <span><b>{{ $color->slogan }}</b></span>
          </div>
        </div>
      </div>
      <!-- Social Media Icons -->
      <div class="row mt-3" id="icon_spacing">
        @if (!empty($data['contactFront']->phone))
        <div class="col-3 p-2">
          <a href="tel:<?php echo $data['contactFront']->phone; ?>">
            <img class="icon_card" src="{{ asset('assets/mobile_icon.png') }}" alt="">
          </a>
        </div>
        @endif
        @if (isset($data['contactFront']->email) && !empty($data['contactFront']->email))
        <div class="col-3 p-2">
          <a href="mailto:<?php echo $data['contactFront']->email; ?>">
            <img class="icon_card" src="{{ asset('assets/email_icon.png') }}" alt="">
          </a>
        </div>
        @endif
        @if (!empty($data['contactFront']->phone))
        <div class="col-3 p-2">
          <a href="https://api.whatsapp.com/send?phone=<?php echo urlencode($data['contactFront']->phone); ?>">
            <img class="icon_card" src="{{ asset('assets/whatsapp_icon.png') }}" alt="">
          </a>
        </div>
        @endif
        @if(isset($color->website))
        <div class="col-3 p-2">
          <a href="{{ $color->website }}" target="_blank">
            <img class="icon_card" src="{{ asset('assets/global_icon.png') }}" alt="">
          </a>
        </div>
        @endif
        @if(isset($links->instagram))
        <div class="col-3 p-2">
          <a href="{{ $links->instagram }}" target="_blank">
            <img class="icon_card" src="{{ asset('assets/instagram_icon.png') }}" alt="">
          </a>
        </div>
        @endif
        @if(isset($links->facebook))
        <div class="col-3 p-2">
          <a href="{{ $links->facebook }}" target="_blank">
            <img class="icon_card" src="{{ asset('assets/facebook_icon.png') }}" alt="">
          </a>
        </div>
        @endif

       @if(isset($links->youtube))
        <div class="col-3 p-2">
          <a href="{{ $links->youtube }}" target="_blank">
            <img class="icon_card" src="{{ asset('assets/youtube_icon.png') }}" alt="">
          </a>
        </div>
        @endif
        
            @if(isset($links->linkedin))
        <div class="col-3 p-2">
           <a href="{{ $links->linkedin }}" target="_blank">
                <img class="icon_card" src="{{ asset('assets/linkdin_icon.png') }}" alt="">
              </a>
        </div>
    @endif

      </div>
      <div class="row mt-5">
        <div class="col-md-12 follow_us" style="background-color: {{ $color->color }};">
          <h2>Follow Us on!!</h2>
        </div>
      </div>
    </div>
  </div>
  
  <!--Card End -->
  
<!-- About Us section start -->
@if(isset($data['aboutFront']) && $data['aboutFront']->count() > 0)
<div id="about-us" class="container-fluid pt-4 pb-4 col-sm-12">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>About Us</h2>
            <p> @php echo $data['aboutFront']->about_us @endphp</p>
        </div>
    </div>
</div>
@endif
<!-- About Us section End -->



<!-- Service section start -->

@if($data['serviceFronts']->count() > 0)
<!-- Services Section -->

<section class="services-section-two container" id="services">
    <center>
        <h2 class="mb-4">Our Services</h2>
    </center>
    <div class="container">
        <div class="row">
            <!-- Service Blocks -->
            @foreach($data['serviceFronts'] as $service)
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-4">
                <div class="service-block-two">
                    <div class="inner-box shadow">
                        <div class="image">
                            <div class="service-image" style="height: 210px;">
                                <img src="{{Storage::URL($service->logo)}}" class="card-img-top" alt="Service 6">
                            </div>
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="content">
                                        <div class="content-inner">
                                            <h5>{{$service->service_name }}</h5>
                                            <a class="read-more btn" href="#Inquiry_form">Inquiry</a>
                                            <a class="read-more btn"  href="https://api.whatsapp.com/send?phone=<?php echo urlencode($data['contactFront']->phone); ?>">WhatsApp</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lower-box">
                            <div class="lower-inner">
                                <span class="icon flaticon-world-1"></span>
                                <h5>{{$service->service_name }}</h5>
                                <p>{{$service->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- End Service Blocks -->
        </div>
    </div>
    
</section>
@endif
<!-- Service section End -->

<!-- Video Section Start -->
@if($data['videoFront']->count() > 0)
<section id="video_start" class="mt-5">
    <center>
        <h2 class="video_h2">Videos</h2>
    </center>
    <div class="container col-sm-12">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach($data['videoFront'] as $video)
                <div class="swiper-slide">
                    <div class="card video-card">
                        <div class="card-body col-sm-12">
                            <div class="video-thumbnail">
                                <div class="youtube-video" data-video-id="{{$video->youtube_video_id}}"></div>
                                <div class="play-button"></div>
                                {{-- <p class="card-text">{{$video->title}}</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.mySwiper', {   
   // Default parameters   
   slidesPerView: 4,   
   spaceBetween: 40,   
   // Responsive breakpoints   
   breakpoints: {  
   
      // when window width is <= 320px     
      320: {       
         slidesPerView: 1,
         spaceBetween: 10     
      },     
      // when window width is <= 480px     
      480: {       
         slidesPerView: 2,       
         spaceBetween: 20     
      },   
  
      // when window width is <= 640px     
      640: {       
         slidesPerView: 2,       
         spaceBetween: 30     
      },

      1024: {
        slidesPerView: 3,       
         spaceBetween: 30     
      }
  
   } 
});

    // Load YouTube videos
    document.addEventListener('DOMContentLoaded', function() {
        var youtubeVideos = document.querySelectorAll('.youtube-video');
        youtubeVideos.forEach(function(element) {
            var videoId = element.getAttribute('data-video-id');
            var iframe = document.createElement('iframe');
            iframe.setAttribute('src', 'https://www.youtube.com/embed/' + videoId + '?enablejsapi=1&autoplay=0&controls=1');
            iframe.setAttribute('width', '100%');
            iframe.setAttribute('height', '250px');
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('allowfullscreen', '1');
            element.appendChild(iframe);
        });
    });
</script>
@endif
<!-- End of video Service -->

<!-- Payment Section Start -->
@if($data['paymentFront']->count() > 0)
<section id="payment-details">
    <h2>Payment Details</h2>
    <div class="container">
        <div class="row">
            @foreach($data['paymentFront'] as $payment)
            <div class="col-md-6 col-lg-4">
                <div class="image-container">
                    <img src="{{ Storage::url($payment->image) }}" alt="Image 1" class="img-fluid">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endif
<!-- Payment Section End -->

<!-- Inquiry Section Start -->
<div class="container-fluid" id="Inquiry_form">
    <div class="row g-0 ">
        <div class="col-md-6 padding_zero form_inquiry col-sm-12">
            <div class="row col-sm-12">
                <div class="d-flex justify-content-end">
                    <div class="col-md-8 col-sm-10">
                        <div class="card form_inquiry col-sm-12">
                            <h2 class="text_inquiry mt-2">Inquiry</h2>
                            <div class="card-body">
                            <form method="POST" action="{{ route('inquiry-form.store', ['cardno' => $card_no]) }}" enctype="multipart/form-data">
                            <input type="hidden" name="cardno" value="{{ $card_no }}">        
                                @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 mb-3">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name *" required>
                                        </div>
                                        <div class="col-md-12 col-sm-12 mb-3">
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone *" required>
                                        </div>
                                        <div class="col-md-12 col-sm-12 mb-3">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email *" required>
                                        </div>
                                        <div class="col-md-12 col-sm-12 mb-3">
                                            <input type="text" class="form-control" id="topic" name="topic" placeholder="Topic *" required>
                                        </div>
                                        <div class="col-md-12 col-sm-12 mb-3">
                                            <textarea class="form-control" id="description" name="description" placeholder="Description *" rows="4" required></textarea>
                                        </div>
                                        <div class="col-md-12 col-sm-12 mb-3 inquiry_text">
                                            <p>By using this form . You agree to the processing of your data to conduct consultations and present an offers .</p>
                                        </div>
                                        <div class="col-md-5 col-sm-5 inquiry_btn">
                                            <button type="submit" class="btn inquiry_submit">Submit Now</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 img_form d-none d-sm-block" style="max-width: 100%; background: url({{ asset('/assets/inquiry.jpg') }}); background-size: cover;"></div>
    </div>
</div>
<!-- Inquiry Section End -->


<!-- Contact section start -->
<div class="container contact-container" id="Contact">
    <div class="row">
        <!-- Map Section -->
        <div class="col-md-6 col-sm-12 mb-1 mt-5">
            <div class="map d-flex justify-content-center">
                @php echo ($data['contactFront']->map) @endphp
            </div>
        </div>

        <!-- Contact Details Section -->
        <div class="col-md-6 col-sm-12">
            <h2>Contact Details</h2>
            <div class="row">
                <div class="col-md-12 d-flex">
                    <img src="{{ asset('assets/location.png') }}" class="m-2" height="30" width="30">
                    <div>
                        <h6 class="mb-0">Address:</h6>
                        @if ($data['contactFront'] !== null)
                            <p>{{ $data['contactFront']->address }}</p>
                        @else
                            <p>No address available</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <img src="{{ asset('assets/phone.png') }}" class="m-2" height="30" width="30">
                    <div>
                        <h6 class="mb-0">Phone:</h6>
                        @if ($data['contactFront'] !== null)
                            <p>{{ $data['contactFront']->phone }}</p>
                        @else
                            <p>No phone available</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <img src="{{ asset('assets/email.png')}}" class="m-2" height="30" width="30">
                    <div>
                        <h6>Email:</h6>
                        @if ($data['contactFront'] !== null)
                            <p>{{ $data['contactFront']->email }}</p>
                        @else
                            <p>No email available</p>
                        @endif
                    </div>
                </div>
            </div>
            <ul class="time_display mt-3">
                <li><strong class="Contact_header">Working Hours</strong></li>
                <li>
                    <strong class="contact_days">Sunday:</strong>
                    <span>
                        @if ($data['contactFront'] != null)
                        {{ $data['contactFront']->time_status == true ? $data['contactFront']->sunday_to.' - '.$data['contactFront']->sunday_from : 'Closed' }}
                        @else
                        Closed
                        @endif
                    </span>
                </li>
                <li>
                    <strong class="contact_days">Monday:</strong>
                    <span>
                        <?php
                        if ($data['contactFront'] !== null) {
                            echo $data['contactFront']->mondayStatus == true ?
                                $data['contactFront']->monday_to . ' - ' . $data['contactFront']->monday_from :
                                'Closed';
                        } else {
                            echo 'Closed';
                        }
                        ?>
                    </span>
                </li>
                <li>
                    <strong class="contact_days">Tuesday:</strong>
                    <span>
                        <?php
                        if ($data['contactFront'] !== null) {
                            echo $data['contactFront']->Tuesdaystatus == true ?
                                $data['contactFront']->tuesday_to . ' - ' . $data['contactFront']->tuesday_from :
                                'Closed';
                        } else {
                            echo 'Closed';
                        }
                        ?>
                    </span>
                </li>
                <li>
                    <strong class="contact_days">Wednesday:</strong>
                    <span>
                        <?php
                        if ($data['contactFront'] !== null) {
                            echo $data['contactFront']->Wednesdaystatus == true ?
                                $data['contactFront']->wednesday_to . ' - ' . $data['contactFront']->wednesday_from :
                                'Closed';
                        } else {
                            echo 'Closed';
                        }
                        ?>
                    </span>
                </li>
                <li>
                    <strong class="contact_days">Thursday:</strong>
                    <span>
                        <?php
                        if ($data['contactFront'] !== null) {
                            echo $data['contactFront']->Thursdaystatus == true ?
                                $data['contactFront']->thursday_to . ' - ' . $data['contactFront']->thursday_from :
                                'Closed';
                        } else {
                            echo 'Closed';
                        }
                        ?>
                    </span>
                </li>
                <li>
                    <strong class="contact_days">Friday:</strong>
                    <span>
                        <?php
                        if ($data['contactFront'] !== null) {
                            echo $data['contactFront']->fridaystatus == true ?
                                $data['contactFront']->friday_to . ' - ' . $data['contactFront']->friday_from :
                                'Closed';
                        } else {
                            echo 'Closed';
                        }
                        ?>
                    </span>
                </li>
                <li>
                    <strong class="contact_days">Saturday:</strong>
                    <span>
                        <?php
                        if ($data['contactFront'] !== null) {
                            echo $data['contactFront']->Saturdaystatus == true ?
                                $data['contactFront']->saturday_to . ' - ' . $data['contactFront']->saturday_From :
                                'Closed';
                        } else {
                            echo 'Closed';
                        }
                        ?>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Contact section End -->

<!-- Testimonials section start -->
@if($data['testimonials']->count() > 0)
<section id="Testimonials">
    <center>
        <h2>
            Testimonials
        </h2>
    </center>
    <div class="container mb-5 ">
        <div class="swiper mySwiper_testimonials col-sm-12">
            <div class="swiper-wrapper">
                @foreach($data['testimonials'] as $testmonialsdata)
                <div class="swiper-slide testi">
                    <div class="border rounded  shadow p-3 mb-3 ">
                        <img class="mb-1 quotes_image" src="https://www.svgrepo.com/show/123881/quotation-mark.svg">
                        <p>{{$testmonialsdata->description}}</p>
                        <div class="auther">
                        <img  src="{{Storage::URL($testmonialsdata->image)}}" class="circle testimonials_image">
                            <h4 class="testimonial_auther">{{$testmonialsdata->auther}}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper(".mySwiper_testimonials", {
                pagination: {
                    el: ".swiper-pagination",
                    dynamicBullets: true,
                },
                slidesPerView: "2",
                spaceBetween: 20,
                loop: true,
            });
        </script>
        <script>
            var swiper = new Swiper('.mySwiper_testimonials', {   
           // Default parameters   
           slidesPerView: 4,   
           spaceBetween: 40,   
           // Responsive breakpoints   
           breakpoints: {  
           
              // when window width is <= 320px     
              320: {       
                 slidesPerView: 1,
                 spaceBetween: 10     
              },     
              // when window width is <= 480px     
              480: {       
                 slidesPerView: 2,       
                 spaceBetween: 20     
              },   
          
              // when window width is <= 640px     
              640: {       
                 slidesPerView: 2,       
                 spaceBetween: 30     
              },
        
              1024: {
                slidesPerView: 3,       
                 spaceBetween: 30     
              }
          
           } 
        });
        </script>
    </div>
</section>
@endif
<!-- Testimonials section end -->

<!-- Footer start -->
<div class="footer" id="links">
    <div class="row text-center">
        <div class="col-12 col-sm-12">
             All Rights Reserved | Developed by IdealGroups &copy; 2023 {{ $color->BrandName }} 
        </div>
    </div>
</div>
<!-- Footer end -->

<script>
    const frontImage = document.getElementById('front-image');
    const backImage = document.getElementById('back-image');

    function flipImages() {
        frontImage.style.transform = 'rotateY(180deg)';
        backImage.style.transform = 'rotateY(0deg)';
        setTimeout(() => {
            frontImage.style.display = 'none';
            backImage.style.display = 'block';
        }, 250);
    }

    function unflipImages() {
        backImage.style.display = 'none';
        frontImage.style.display = 'block';
        setTimeout(() => {
            frontImage.style.transform = 'rotateY(0deg)';
            backImage.style.transform = 'rotateY(180deg)';
        }, 10); // Ensure the previous display changes take effect before the animation
    }

    // Set an interval to flip the images automatically
    setInterval(() => {
        flipImages();
        setTimeout(unflipImages, 2000); // Adjust the time between flips as needed
    }, 4000); // Adjust the total time interval as needed
</script>

<script>
    function showDetails(card) {
        card.querySelector('.details').style.display = 'flex';
    }

    function hideDetails(card) {
        card.querySelector('.details').style.display = 'none';
    }
</script>

<script>
    document.querySelectorAll('a.nav-link').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
</script>

<script>
    const navbarlinks = document.querySelectorAll('#navbar .scrollto');

    const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach(navbarlink => {
            const sectionId = navbarlink.getAttribute('href').substring(1); // Get the target section's ID
            const section = document.getElementById(sectionId);
            if (section && position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active');
            } else {
                navbarlink.classList.remove('active');
            }
        });
    }

    window.addEventListener('load', navbarlinksActive);
    window.addEventListener('scroll', navbarlinksActive);
</script>



<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

@endif
</body>
</html>