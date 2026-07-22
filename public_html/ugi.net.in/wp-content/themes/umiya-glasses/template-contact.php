<?php 
/* Template Name: Contact Template */
get_header(); 
?>
    <div class="about-banner conatct-banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="main-heading">
                    Contact Us
                </h1>
            </div>
        </div>
    </div>


    <section class="contact-pageheader">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-caption">
                        <h1 class="main-title"><?php the_field('contact_heading'); ?></h1>
                        <p class="sub-title">
                            <?php the_field('contact_subheading'); ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <h3 class="contact-info-title">Contact Me</h3>
                        <div class="row">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="space-medium">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="map">
                        <?php the_field('contact_map_code'); ?>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="address">
                        <h3 class="main-title">Contact Info</h3>
                        <p class="sub-title"><?php the_field('contact_map_heading'); ?></p>
                        <div class="contact-info">
                            <?php the_field('contact_address'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>