<!-- Page Banner Start -->

<section class="design-feature-area overflow-hidden pt-130 pb-100 text-white bgc-black-with-lighting rel z-1">

    <div class="container">

        <div class="banner-inner rpt-10">

            <h1 class="page-title wow fadeInUp delay-0-2s">services</h1>

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb justify-content-center wow fadeInUp delay-0-4s">

                    <li class="breadcrumb-item"><a href="home.php">home</a></li>

                    <i class="fal fa-angle-right icon-right"></i>

                    <li class="breadcrumb-item active">services</li>

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

                    <span class="sub-title style-two mb-15">Working Process</span>

                    <h2 class="productExperience">How Does We Works?</h2>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-6">

                <div class="productWorkPlan">

                    <img src="<?php echo base_url(); ?>/assets/images/product_img/icon_1.png" alt="Discuss">

                    <h2>Project Discussion</h2>

                    <p>Prepare a project overview or brief that includes a summary, objectives, timeline and key
                        deliverables. Clearly outline team roles and communication plans.</p>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="productWorkPlan">

                    <img src="<?php echo base_url(); ?>/assets/images/product_img/icon_2.png" alt="Planing">

                    <h2>Work Planning</h2>

                    <p>Set Goals & Objectives, Define the Scope of Your Work Plan, Estimate What Resources Are Needed,
                        Assign Roles & Responsibilities, Estimate Costs & Create a Budget, Create a Project Schedule.
                    </p>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="productWorkPlan">

                    <img src="<?php echo base_url(); ?>/assets/images/product_img/icon_3.png" alt="Analysis">

                    <h2>Design Analysis</h2>

                    <p>This analysis helps identify potential issues with design part removal from the Design or Art and
                        allows for adjustments to be made before creation, preventing costly errors.</p>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="productWorkPlan">

                    <img src="<?php echo base_url(); ?>/assets/images/product_img/icon_4.png" alt="Discuss">

                    <h2>Testing & Launch</h2>

                    <p>This process includes creating test plans, executing tests, analyzing results, and iteratively
                        improving the product based on feedback.
                        Finally, the product or feature is launched after successful testing.</p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- Working Process end -->



<!-- Design Featured Start -->

<section class="design-feature-area overflow-hidden pt-130 pb-100 mb-80 text-white bgc-black-with-lighting rel z-1">

    <div class="container">

        <div class="section-title text-center wow fadeInUp delay-0-2s">

            <span class="sub-title mb-10">Our Service</span>

            <h2>What We Provide?</h2>

        </div>

        <div class="row">



            <?php

            foreach ($categories as $category) {

                ?>

                <div class="col-sm-3">

                    <a href="<?php echo base_url(); ?>/category/<?php echo $category['id']; ?>">
                        <div class="service-item style-three wow fadeInRight delay-0-3s">

                            <div class="icon"><img
                                    src="<?php echo base_url(); ?>/assets/uploads/category/<?php echo $category['image']; ?>"
                                    alt="logo design"></div>

                            <div class="content">

                                <h4><?php echo $category['title']; ?>
                                </h4>

                                <i class="fal fa-long-arrow-right more-btn"></i>


                            </div>

                        </div>
                    </a>

                </div>

                <?php

            }

            ?>







        </div>

    </div>

</section>

<!-- Design Featured End -->



<!-- Call to Action Area start -->

<?php include('brand_page.php'); ?>

<!-- Call to Action Area End -->
<style>
    .productWorkPlan p {
        line-height: 33px !important;
        padding: 0px 30px !important;
        font-size: 20px !important;
    }
</style>