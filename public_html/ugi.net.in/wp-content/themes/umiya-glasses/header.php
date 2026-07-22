<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <!-- Custom styles for this template with bootstrap css -->
    <!-- build:css -->

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/app.css" rel="stylesheet" type="text/css">

    <!-- Developer STYLE -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/dev.css" rel="stylesheet" type="text/css">
    <?php wp_head(); ?>
</head>

<body>
    <div class="top-header">
        <div class="container">
            <div class="d-flex top-links">
                <div class="contact-links">
                    <a href="tel:<?php the_field('top_phone','option'); ?>"><i class="fas fa-phone-alt"></i> <span><?php the_field('top_phone','option'); ?></span></a>
                    <a href="mailto:<?php the_field('top_email','option'); ?>"><i class="fas fa-envelope"></i> <span><?php the_field('top_email','option'); ?></span></a>
                </div>
                <div class="social-links ms-auto">
                    <?php if( have_rows('top_social_media_icons','option') ): ?>
                        <?php while( have_rows('top_social_media_icons','option') ): the_row();  ?>
                            <a target="_blank" href="<?php the_sub_field('icon_url','option'); ?>"><i class="<?php the_sub_field('icon_class','option'); ?>"></i></a>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="<?php echo site_url(); ?>">
                    <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- <ul class="navbar-nav ms-auto">
                        <li class="active">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="">
                            <a href="about.html">About</a>
                        </li>
                        <li class="">
                            <a href="products.html">Products</a>
                        </li>
                        <li class="">
                            <a href="portfolio.html">Portfolio</a>
                        </li>
                        <li class="">
                            <a href="blog.html">Blog</a>
                        </li>
                        <li class="">
                            <a href="conatct-page.html">Contact</a>
                        </li>
                    </ul> -->
                    <?php
                        $args = array(      
                            'menu_location'              => 'primary',
                            'menu'       => 'menu-main-menu',
                            'menu_class'   => 'navbar-nav ms-auto',
                            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'          => new WP_Bootstrap_Navwalker(),
                        );
                        wp_nav_menu( $args ); 
                    ?>
                </div>
            </nav>
        </div>
    </header>