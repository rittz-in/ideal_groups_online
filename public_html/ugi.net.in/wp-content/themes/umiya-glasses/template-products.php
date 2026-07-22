<?php 
/* Template Name: Products Template */
get_header(); 
?>
    <div class="about-banner product-banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="main-heading">
                    Products
                </h1>
            </div>
        </div>
    </div>

    <section class="about-us logo-after">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="about-img">
                        <img class="img-fluid" src="<?php the_field('products_right_image'); ?>" alt="about-img">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content">
                        <div class="info-area">
                            <p class="sub-title">
                               Our Products
                            </p>
                            <h2 class="main-title">
                                <?php the_field('products_heading'); ?>
                            </h2>
                            <?php the_field('products_content'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if( have_rows('products_list_one') ): ?>
        <?php while( have_rows('products_list_one') ): the_row(); ?>
            <?php if( get_row_layout() == 'right_image_left_content' ): ?>
                <section class="product bg-gray">
                    <div class="container">
                        <div class="row">
                                <div class="col-lg-6">
                                    <div class="about-img">
                                        <img class="img-fluid" src="<?php the_sub_field('right_image'); ?>" alt="who-we">
                                    </div>
                                </div>
                            <div class="col-lg-6">
                                <div class="content">
                                    <div class="info-area">
                                        <!-- <p class="sub-title">
                                            Product2
                                        </p> -->
                                        <h2 class="main-title">
                                            <?php the_sub_field('left_heading'); ?>
                                        </h2>
                                        <?php the_sub_field('left_content'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php elseif( get_row_layout() == 'left_image_right_content' ): ?>
                <section class="product">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="content">
                                    <div class="info-area">
                                        <!-- <p class="sub-title">
                                            Product1
                                        </p> -->
                                        <h2 class="main-title">
                                            <?php the_sub_field('right_heading'); ?>
                                        </h2>
                                        <?php the_sub_field('right_content'); ?>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="about-img">
                                    <img class="img-fluid" src="<?php the_sub_field('left_image'); ?>" alt="who-we">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
            
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