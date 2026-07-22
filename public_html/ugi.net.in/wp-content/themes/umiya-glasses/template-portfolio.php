<?php 
/* Template Name: Portfolio Template */
get_header(); 
?>
   <div class="about-banner portfolio-banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="main-heading">
                    Portfolio
                </h1>
            </div>
        </div>
    </div>

    <section class="projects logo-before border-after">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="project-img">
                        <img class="img-fluid" src="<?php the_field('featured_work_image'); ?>" alt="project-img" style="height: auto; min-height: 792px;">
                        <div class="img-info">
                            <h6><?php the_field('featured_work_title'); ?></h6>
                            <p><?php the_field('featured_work_subtitle'); ?></p>
                        </div>
                    </div>
                </div>
                <?php if( have_rows('feature_work_listing') ): ?>
                    <?php while( have_rows('feature_work_listing') ): the_row(); ?>
                        <?php if( get_row_layout() == 'feature_two_column_listing' ): ?>
                            <div class="col-md-8">
                                <div class="row min-height">
                                    <?php if( have_rows('feature_image_two_column') ): ?>
                                        <?php while( have_rows('feature_image_two_column') ): the_row();  ?>
                                            <div class="col-md-6">
                                                <div class="project-img">
                                                    <img class="img-fluid" src="<?php the_sub_field('feature_image'); ?>" alt="project-img">
                                                    <div class="img-info">
                                                        <h6><?php the_sub_field('featured_heading'); ?></h6>
                                                        <p><?php the_sub_field('featured_subheading'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php elseif( get_row_layout() == 'feature_three_column_listing' ): ?>
                            <?php if( have_rows('feature_image_tree_column',) ): ?>
                                <?php while( have_rows('feature_image_tree_column') ): the_row();  ?>
                                    <div class="col-md-4 min-height">
                                        <div class="project-img">
                                            <img class="img-fluid" src="<?php the_sub_field('feature_image'); ?>" alt="project-img">
                                            <div class="img-info">
                                                <h6><?php the_sub_field('featured_heading'); ?></h6>
                                                <p><?php the_sub_field('featured_subheading'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                             <?php endif; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
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
                                    <p><?php the_sub_field('clients_info','option'); ?></p>
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
                    <button class="btn btn-primary" type="submit" id="button-addon2">SUBMIT</button>
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