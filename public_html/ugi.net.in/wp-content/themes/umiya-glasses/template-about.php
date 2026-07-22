<?php 
/* Template Name: About Template */
get_header(); 
?>
    <div class="about-banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="main-heading">
                    About Us
                </h1>
            </div>
        </div>
    </div>

    <section class="about_us">
        <div class="main-content">
            <div class="container">
                <h3 class="main-title">
                    <?php the_field('about_us_heading'); ?>
                </h3>
                <p><?php the_field('about_us_subheading'); ?></p>
            </div>
        </div>
        <div class="sub-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="content-info">
                            <h4><?php the_field('about_left_heading'); ?></h4>
                            <?php the_field('about_left_content'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-info">
                            <h4><?php the_field('about_right_heading'); ?></h4>
                            <?php the_field('about_right_content'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="what-we">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-img">
                        <img class="img-fluid" src="<?php the_field('who_image'); ?>" alt="who-we">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="content">
                        <div class="info-area">
                            <p class="sub-title">
                                <?php the_field('who_top_heading'); ?>
                            </p>
                            <h2 class="main-title">
                                <?php the_field('who_heading'); ?>
                            </h2>
                           <!--  <p class="main-para">Contrary to popular belief, Lorem Ipsum is not simply random text. It
                                has roots in a piece of classical Latin literature
                                from 45 BC.</p>
                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of
                                type and scrambled it to make a type specimen book. It has survived not only five
                                centuries, but also the leap into
                                electronic typesetting, Lorem Ipsum has been the industry's standard dummy text ever
                                since the 1500s, when an unknown printer took a galley of type and scrambled it to make
                                a type specimen book. It has survived not only five centuries, but also the leap into
                                electronic typesetting,</p> -->
                        	<?php the_field('who_content'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="why-us">
        <div class="container">
            <div class="title-area">
                <p class="sub-title">WHY WE ARE</p>
                <h4 class="main-title">
                    <?php the_field('why_heading'); ?>
                </h4>
            </div>
            <div class="row justify-content-center">
            	<?php if( have_rows('why_we_are_features') ): ?>
                    <?php 
                    	$count = 0;
                    	while( have_rows('why_we_are_features') ): the_row(); 
                    	$count++;
                    ?>
		                <div class="col-sm-4 col-lg-2">
		                    <div class="box">
		                        <!-- <span><?php echo "0".$count; ?></span> -->
		                        <img class="img-fluid" src="<?php the_sub_field('why_subheading'); ?>" alt="Card">
		                        <h4><a href="#"><?php the_sub_field('why_heading'); ?></a></h4>
		                        <!-- <p><?php the_sub_field('why_subheading'); ?></p> -->
		                    </div>
		                </div>
		            <?php endwhile; ?>
                <?php endif; ?>
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
                    <input type="text" class="form-control" placeholder="Enter Email" aria-label="Enter Email"
                        aria-describedby="button-addon2">
                    <button class="btn btn-primary btn-stay" type="submit" id="button-addon2">SUBMIT</button>
                </div>
            </div>
        </div>
    </section>

    <<section class="clients">
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