<?php 
/* Template Name: Homepage */
get_header(); 
?>


    <div class="home-banner" style="background-image: url(<?php the_field('banner_image'); ?>);">
        <div class="container">
            <div class="banner-content">
                <h1 class="main-heading">
                    <?php the_field('banner_heading'); ?>
                </h1>
                <p>
                    <?php the_field('banner_subheading'); ?>
                </p>
                <a href="<?php the_field('banner_button_url'); ?>" class="btn btn-primary btn-banner"><?php the_field('banner_button_text'); ?></a>
            </div>
        </div>
    </div>


    <section class="about-us logo-after">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="about-img">
                        <img class="img-fluid" src="<?php the_field('about_image'); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content">
                        <div class="info-area">
                            <p class="sub-title">
                                About Us
                            </p>
                            <h2 class="main-title">
                                <?php the_field('about_heading'); ?>
                            </h2>
                            <?php the_field('about_text'); ?>
                            <a href="<?php the_field('about_button_url'); ?>" class="btn btn-primary btn-more"><?php the_field('about_button_text'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <div class="title-area">
                <p>What We Do</p>
                <h3 class="main-title">Our Products</h3>
            </div>
        </div>
        <div class="img-slider">
            <div id="image-slider" class="owl-carousel owl-theme">
                <?php
                    $servicesArgs = array(
                      'post_type' => 'um_services',
                      'posts_per_page' => 8,
                      'order' => 'ASC',
                    );
                    $myServices = new WP_Query($servicesArgs);
                    if( $myServices->have_posts() ):
                        while( $myServices->have_posts() ): $myServices->the_post();
                            $serviceId    = get_the_ID();
                            $serviceTitle = get_the_title();
                            $serviceLink  = get_permalink($serviceId);
                            $featuredImgUrl = get_the_post_thumbnail_url($serviceId, 'full');
                ?>
                <div class="img-card">
                    <img class="img-fluid" src="<?php echo $featuredImgUrl; ?>" alt="img">
                    <p><?php echo $serviceTitle; ?></p>
                    <a class="arrow-more" href="<?php echo $serviceLink; ?>">
                        <i class="far fa-long-arrow-right"></i>
                    </a>
                </div>
                <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>


    <section class="projects logo-before border-after">
        <div class="container">
            <div class="title-area">
                <p class="sub-title">Projects</p>
                <h3 class="main-title"><?php the_field('project_heading'); ?></h3>
                <p><?php the_field('project_subheading'); ?></p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="project-img">
                        <img class="img-fluid" src="<?php the_field('project_featured_image'); ?>" alt="project-img" style="height: auto; min-height: 792px;">
                        <div class="img-info">
                            <h6><?php the_field('project_featured_heading'); ?></h6>
                            <p><?php the_field('project_featured_subheading'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row min-height">
                        <?php if( have_rows('our_pojects') ): ?>
                            <?php while( have_rows('our_pojects') ): the_row();  ?>
                                <div class="col-md-6">
                                    <div class="project-img">
                                        <img class="img-fluid" src="<?php the_sub_field('project_image'); ?>" alt="project-img">
                                        <div class="img-info">
                                            <h6><?php the_sub_field('project_heading'); ?></h6>
                                            <!-- <p><?php //the_sub_field('project_subheading'); ?></p> -->
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <a href="<?php the_field('project_button_url'); ?>" class="btn btn-outline-secondary"><?php the_field('project_button_text'); ?></a>
        </div>
    </section>


    <section class="achievments">
        <div class="container">
            <div class="achive-content">
                <div class="title-area">
                    <!-- <p class="sub-title">Lorem Ipsum</p> -->
                    <h4 class="main-title">
                        <?php the_field('achiev_heading','option'); ?>
                    </h4>
                    <p><?php the_field('achiev_subheading','option'); ?></p>
                </div>
                <div class="row">
                    <?php if( have_rows('our_achievments','option') ): ?>
                        <?php while( have_rows('our_achievments','option') ): the_row();  ?>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                <div class="achie-card">
                                    <div class="img-wraper">
                                        <img class="img-fluid" src="<?php the_sub_field('icon','option'); ?>" alt="user">
                                    </div>
                                    <div class="achie-info">
                                        <h6><?php the_sub_field('count','option'); ?></h6>
                                        <p><?php the_sub_field('heading','option'); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>



    <section class="testimonials logo-after border-before">
        <div class="container">
            <div class="title-area">
                <p class="sub-title">Testimonials</p>
                <h4 class="main-title">
                    <?php the_field('clients_heading','option'); ?>
                </h4>
                <p><?php the_field('clients_subheading','option'); ?></p>
            </div>

            <div class="img-card-slider">
                <div id="image-card-slider" class="owl-carousel owl-theme">
                    <?php if( have_rows('our_clients','option') ): ?>
                        <?php while( have_rows('our_clients','option') ): the_row();  ?>
                            <div class="card">
                                <div class="card-img">
                                    <img class="img-fluid" src="<?php the_sub_field('clients_image','option'); ?>" alt="Card">
                                </div>
                                <div class="card-info">
                                    <p><strong><?php the_sub_field('clients_info','option'); ?></strong></p>
                                    <br/>
                                    <h6><?php the_sub_field('clients_name','option'); ?></h6>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>


    <section class="newslatter">
        <div class="container">
            <div class="newslatter-info">
                <p class="sub-title">Join our mail list</p>
                <h5 class="main-title">Stay in touch</h5>
                <div class="input-group">
                    <!-- <input type="text" class="form-control" placeholder="Enter Email" aria-label="Enter Email"
                        aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="submit" id="button-addon2">SUBMIT</button> -->
                  	<?php echo do_shortcode('[mc4wp_form id="298"]'); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="clients">
        <div class="container">
            <div class="clients-info">
                <p class="sub-title">Clients</p>
                <h5 class="main-title"> <?php the_field('partners_heading','option'); ?></h5>
                <p> <?php the_field('partners_subheading','option'); ?></p>
            </div>
            <div class="row align-items-center">
                <?php if( have_rows('partners_logos','option') ): ?>
                    <?php while( have_rows('partners_logos','option') ): the_row();  ?>
                        <div class="col">
                            <div class="company-img">
                                <img class="img-fluid" src="<?php the_sub_field('partners_icon','option'); ?>" alt="company">
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>


<?php get_footer(); ?>