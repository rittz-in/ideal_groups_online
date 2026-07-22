<!-- Page Banner Start -->

<section class="design-feature-area overflow-hidden pt-130 pb-100 text-white bgc-black-with-lighting rel z-1">

    <div class="container">

        <div class="banner-inner rpt-10">

            <h1 class="page-title wow fadeInUp delay-0-2s">Our Clients</h1>

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb justify-content-center wow fadeInUp delay-0-4s">

                    <li class="breadcrumb-item"><a href="home.php">home</a></li>

                    <i class="fal fa-angle-right icon-right"></i>

                    <li class="breadcrumb-item active">Our Clients</li>

                </ol>

            </nav>

        </div>

    </div>

</section>

<!-- Page Banner End -->



<!-- Working Process start -->

<section class="pt-80 pb-95 rel z-1">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="section-title text-center mb-50">

                    <h2 class="clientsExperience">Our Clients</h2>

                </div>

            </div>

        </div>

        <div class="row">

            <?php

            foreach ($clients as $client) {

                ?>

                <div class="col-lg-3 mb-5 pt-20">

                    <div class="clientsLogo">

                        <img src="<?php echo base_url(); ?>/assets/uploads/clients/<?php echo $client['image']; ?>"
                            alt="logo">

                    </div>

                </div>

            <?php

            }

            ?>





        </div>





    </div>

</section>

<!-- Working Process end -->



<!-- Call to Action Area start -->

<?php include('brand_page.php'); ?>

<!-- Call to Action Area End -->