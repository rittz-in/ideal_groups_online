<header class="main-header header-two">

    <!--Header-Upper-->

    <div class="header-upper">

        <div class="container">



            <div class="header-inner rel d-flex align-items-center">

                <div class="logo-outer">

                    <div class="logo"><a href="<?php echo base_url(); ?>"><img
                                src="<?php echo base_url(); ?>/assets/images/logos/ideal_group_logo_1_small.png"
                                alt="Logo" title="Logo" class="mainLogo"></a></div>

                </div>



                <div class="nav-outer clearfix">

                    <!-- Main Menu -->

                    <nav class="main-menu navbar-expand-lg">

                        <div class="navbar-header">

                            <div class="mobile-logo my-15">

                                <a href="home.php">

                                    <img src="<?php echo base_url(); ?>/assets/images/logos/ideal_group_logo_1_small.png"
                                        alt="Logo" title="Logo">

                                </a>

                            </div>



                            <!-- Toggle Button -->

                            <button type="button" class="navbar-toggle" data-bs-toggle="collapse"
                                data-bs-target=".navbar-collapse">

                                <span class="icon-bar"></span>

                                <span class="icon-bar"></span>

                                <span class="icon-bar"></span>

                            </button>

                        </div>



                        <div class="navbar-collapse collapse clearfix">

                            <ul class="navigation clearfix">

                                <li><a href="<?php echo base_url(); ?>"
                                        class="<?php if ($page_name == "Home") {
                                            echo "active_menu";
                                        } ?>">Home</a></li>

                                <li><a href="<?php echo base_url(); ?>/about"
                                        class="<?php if ($page_name == "About") {
                                            echo "active_menu";
                                        } ?>">About</a></li>

                                <li><a href="<?php echo base_url(); ?>/products"
                                        class="<?php if ($page_name == "Products" || $page_name == "Products_list") {
                                            echo "active_menu";
                                        } ?>">Services</a>
                                </li>



                                <!-- <li class="dropdown"><a href="#" class="<?php //if($page_name == "Products") { echo "active_menu";} ?>"><span>Products</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>                                            

                                            <ul>

                                                <li><a href="#">Category 1</a></li>

                                                <li><a href="#">Category 2</a></li>

                                                <li><a href="#">Category 3</a></li>

                                                <li><a href="#">Category 4</a></li>

                                                <li><a href="#">Category 5</a></li>

                                            </ul>

                                        </li>     -->



                                <li><a href="<?php echo base_url(); ?>/clients"
                                        class="<?php if ($page_name == "Clients") {
                                            echo "active_menu";
                                        } ?>">Clients</a>
                                </li>

                                <li><a href="<?php echo base_url(); ?>/contact"
                                        class="<?php if ($page_name == "Contact") {
                                            echo "active_menu";
                                        } ?>">Contact</a>
                                </li>

                                <!--<li class="dropdown"><a href="#">services</a>

                                            <ul>

                                                <li><a href="services.html">Popular Services</a></li>

                                                <li><a href="service-details.html">service details</a></li>

                                            </ul>

                                        </li>-->

                            </ul>

                        </div>



                    </nav>

                    <!-- Main Menu End-->

                </div>



                <!-- Nav Search

                        <div class="nav-search py-15">

                            <button class="far fa-search"></button>

                            <form action="#" class="hide">

                                <input type="text" placeholder="Search" class="searchbox" required="">

                                <button type="submit" class="searchbutton far fa-search"></button>

                            </form>

                        </div> -->



                <!-- Menu Button -->

                <div class="menu-btns">

                    <a href="<?php echo base_url(); ?>/contact" class="theme-btn style-three" data-toggle="cat_modal"
                        data-target="#mainModal">Get a Quote</a>



                    <!-- menu sidbar 

                            <div class="menu-sidebar">

                                <button>

                                    <span class="icon-bar"></span>

                                    <span class="icon-bar"></span>

                                    <span class="icon-bar"></span>

                                </button>

                            </div>-->

                </div>

            </div>

        </div>

    </div>

    <!--End Header Upper-->

</header>