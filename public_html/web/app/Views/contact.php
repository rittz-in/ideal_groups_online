<!-- Page Banner Start -->
<section class="design-feature-area overflow-hidden pt-130 pb-100 text-white bgc-black-with-lighting rel z-1">
    <div class="container">
        <div class="banner-inner rpt-10">
            <h1 class="page-title wow fadeInUp delay-0-2s">Contact Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center wow fadeInUp delay-0-4s">
                    <li class="breadcrumb-item"><a href="home.php">home</a></li>
                    <i class="fal fa-angle-right icon-right"></i>
                    <li class="breadcrumb-item active">Contact Us</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Page Banner End -->

<!-- Contact Us Page Area start -->
<section class="contact-us-page-area py-130">
    <div class="container">

        </p>
        <div class="row justify-content-between">
            <div class="col-lg-7">
                <p class="mb-5">
                    <?php
                    echo $session_data = (get_flash_data($session_flash) != '') ? '<div class="container">' . get_flash_data($session_flash) . '</div>' : '';
                    ?>
                <div class="contact-content rmb-65 wow fadeInRight delay-0-2s">
                    <div class="section-title mb-25 mt-10">
                        <span class="sub-title style-two mb-15">Contact Us</span>
                    </div>
                    <form id="contactForm" class="contactForm z-1 rel" action="<?php echo base_url(); ?>/contact"
                        name="contactForm" method="post">
                        <div class="row pt-15">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Full Name">
                                    <?php echo (isset($validation) && $validation->getError('name') != '') ? '<label class="error text-danger">' . $validation->getError('name') . '</label>' : '' ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Email Address">
                                    <?php echo (isset($validation) && $validation->getError('email') != '') ? '<label class="error text-danger">' . $validation->getError('email') . '</label>' : '' ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" id="phone" name="phone" class="form-control"
                                        placeholder="Phone Number">
                                    <?php echo (isset($validation) && $validation->getError('phone') != '') ? '<label class="error text-danger">' . $validation->getError('phone') . '</label>' : '' ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Write Message</label>
                                    <textarea name="message" id="message" class="form-control" rows="4"
                                        placeholder="Write Message"></textarea>
                                    <?php echo (isset($validation) && $validation->getError('message') != '') ? '<label class="error text-danger">' . $validation->getError('message') . '</label>' : '' ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group pt-5 mb-0">
                                    <button type="submit" class="theme-btn w-100">Send Message</button>
                                    <div id="msgSubmit" class="hidden"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="contact-info wow fadeInLeft delay-0-2s">

                    <div class="contact-info-item style-two">
                        <div class="icon">
                            <i class="far fa-envelope-open-text"></i>
                        </div>
                        <div class="content">
                            <span class="title">Email address</span>
                            <span class="text">
                                <a href="mailto:idealinfosoft21@gmail.com"> idealinfosoft21@gmail.com</a>
                            </span>
                        </div>
                    </div>
                    <div class="contact-info-item style-two">
                        <div class="icon">
                            <i class="far fa-phone"></i>
                        </div>
                        <div class="content">
                            <span class="title">Phone Number</span>
                            <span class="text">
                                Call <a href="tel: +91 84 607 53102"> +91 84 607 53102</a><br>
                                Whatsapp : +9632145789
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Us Page Area end -->

<!-- Location Map Area Start -->
<div class="row locationSection">
    <div class="col-md-6">
        <div class="contact-info-item style-two">
            <div class="icon">
                <i class="fal fa-map-marker-alt"></i>
            </div>
            <div class="content">
                <span class="title addressTitle">Main Address</span>
                <span class="text">115, Blue Diamond Complex, B/h, Fatehgunj Petrol Pump, Fatehgunj Vadodara
                    - 390002</span>
            </div>
        </div>
        <div class="contact-page-map wow fadeInUp delay-0-2s">
            <div class="our-location">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.7766914942595!2d73.18657496426898!3d22.324283647666817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395fcf13db326c2f%3A0xa1d818f823fb2483!2sIDEAL%20GROUPS!5e0!3m2!1sen!2sin!4v1668712007636!5m2!1sen!2sin"
                    height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="frameMap"></iframe>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="contact-info-item style-two">
            <div class="icon">
                <i class="fal fa-map-marker-alt"></i>
            </div>
            <div class="content">
                <span class="title addressTitle">Branch Address</span>
                <span class="text">3770 Densbury Dr, Mississauga, ON, L5N 6Z2</span>
            </div>
        </div>
        <div class="contact-page-map wow fadeInUp delay-0-2s">
            <div class="our-location">
                <!-- <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.7766914942595!2d73.18657496426898!3d22.324283647666817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395fcf13db326c2f%3A0xa1d818f823fb2483!2sIDEAL%20GROUPS!5e0!3m2!1sen!2sin!4v1668712007636!5m2!1sen!2sin"
                    height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="frameMap"></iframe> -->

                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m22!1m8!1m3!1d2338.782520134488!2d-79.7913643954679!3d43.57652834576535!3m2!1i1024!2i768!4f13.1!4m11!3e2!4m3!3m2!1d43.576417!2d-79.788778!4m5!1s0x882b6bcc6c23e365%3A0x20aec296cbbea966!2s3770%20Densbury%20Dr%2C%20Mississauga%2C%20ON%20L5N%206Z2!3m2!1d43.5764244!2d-79.7887259!5e1!3m2!1sen!2sin!4v1752058589644!5m2!1sen!2sin"
                    height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="frameMap"></iframe>



            </div>
        </div>
    </div>
</div>

<!-- Location Map Area End -->

<!-- Call to Action Area start -->
<?php include('brand_page.php'); ?>
<!-- Call to Action Area End -->
<style>
    .addressTitle {
        font-size: 20px !important;
        font-weight: bold !important;
    }

    .locationSection {
        margin-bottom: 25px;
    }

    .contact-info-item {
        margin-bottom: 10px !important;
    }
</style>