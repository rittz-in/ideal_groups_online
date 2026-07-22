    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-4 col-md-4">
                    <div class="footer-links">
                        <h6 class="footer-title">Quick Links</h6>
                        <!-- <ul>
                            <li>
                                <a href="">Home</a>
                            </li>
                            <li>
                                <a href="">Services</a>
                            </li>
                            <li>
                                <a href="">Our Story</a>
                            </li>
                            <li>
                                <a href="">Featured Project</a>
                            </li>
                            <li>
                                <a href="">Gallery</a>
                            </li>
                            <li>
                                <a href="">Conatct Us</a>
                            </li>
                        </ul> -->
						<?php
                            $args = array(      
                                'menu_location'              => 'primary',
                                'menu'       => 'menu-main-menu',
                            );
                            wp_nav_menu( $args ); 
                        ?>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4">
                    <div class="footer-links">
                        <h6 class="footer-title">Other Links</h6>
                        <?php
                      		$args = array(      
                                'menu'       => 'other-links',
                            );
                            wp_nav_menu( $args ); 
                      	?>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-4">
                    <div class="contact-links">
                        <h6 class="footer-title">Contact Us</h6>
                        <p>
                            <?php the_field('footer_address','option'); ?>
                        </p>
                        <a href="tel:<?php the_field('top_phone','option'); ?>"><i class="fas fa-phone-alt"></i> <span><?php the_field('top_phone','option'); ?></span></a>
                        <a href="mailto:<?php the_field('top_email','option'); ?>"><i class="fas fa-envelope"></i> <span><?php the_field('top_email','option'); ?></span></a>
                    </div>
                </div>
            </div>
            <div class="copyright-area">
                <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png" alt="logo">
                <!-- <a href="<?php //site_url(); ?>"><?php //the_field('footer_copyright','option'); ?></a> -->
				<?php the_field('footer_copyright','option'); ?>
                <div class="social-links">
                   <a target="_blank" href="https://www.facebook.com/umiyaglassindustries"><img src="https://ugi.net.in/wp-content/uploads/2021/12/fb.png" style="
                      width: 40px;
                      height: auto;
                      "></a>
                   <a target="_blank" href="https://g.page/r/CYrp32-_ZaceEAE"><img src="https://ugi.net.in/wp-content/uploads/2021/12/google.png" style="
                      width: 40px;
                      height: auto;
                      "></a>
                   <a target="_blank" href="https://www.linkedin.com/company/umiyaglassindustries"><img src="https://ugi.net.in/wp-content/uploads/2021/12/in.png" style="
                      width: 40px;
                      height: auto;
                      "></a>
                   <a target="_blank" href="https://www.instagram.com/umiyaglassindustries/"><img src="https://ugi.net.in/wp-content/uploads/2021/12/insta.png" style="
                      width: 40px;
                      height: auto;
                      "></a>
                </div>
            </div>
        </div>
    </footer>




    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery-3.1.0.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/app.js"></script>

<?php wp_footer(); ?>
</body>
</html>