<!-- Page Banner Start -->
<section class="design-feature-area overflow-hidden pt-130 pb-100 text-white bgc-black-with-lighting rel z-1">
    <div class="container">
        <div class="banner-inner rpt-10">
            <h1 class="page-title wow fadeInUp delay-0-2s"><?php echo $category_name['title']; ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center wow fadeInUp delay-0-4s">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">home</a></li>
                    <i class="fal fa-angle-right icon-right"></i>
                    <li class="breadcrumb-item active"><?php echo $category_name['title']; ?></li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Page Banner End -->

<!-- Button trigger modal -->






<!-- Price Area start -->

<!-- Price Area end -->
<!-- Price Area start -->

<?php
if ($category_name['quality'] != '') {
    $quality = explode(",", $category_name['quality']);
    $qty = explode(",", $category_name['qty']);
    $price = explode(",", $category_name['price']);
    ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title_head" id="exampleModalLabel"><?php echo $category_name['title']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="category_section">
                    <div class="modal-body">
                        <?php
                        $attributes = 'name="edit_event" id="kt_account_profile_details_form" class="form" enctype="multipart/form-data" novalidate="novalidate"';
                        $hidden = array();
                        echo form_open(route_to('category_form_add', $category_name['id']), $attributes, $hidden);
                        ?>
                        <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $category_name['id']; ?>" />
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="quality" id="quality" class="form-control form_space">
                                        <?php
                                        $i = 1;
                                        for ($i = 0; $i < count($quality); $i++) {
                                            if ($quality[$i] != '' && $qty[$i] != '' && $price[$i] != '') {
                                                ?>
                                                <option value="<?php echo $quality[$i]; ?>"><?php echo $quality[$i]; ?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="qty" id="qty"
                                        placeholder="Total No of Quantity">
                                </div>



                                <div class="form-group">
                                    <input type="text" id="fname" name="fname" class="form-control require-input"
                                        placeholder="Full Name">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="mobile" id="mobile"
                                        placeholder="Phone Number">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="email" id="email"
                                        placeholder="Email Address">
                                </div>









                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="category_section"
                        class="btn btn-primary guestBtnModify  category_form">Submit</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
                <?php
                echo form_close();
                ?>
            </div>
        </div>
    </div>




    <section class="pt-80 pb-95 rel z-1">
        <div class="container">
            <?php
            echo $session_data = (get_flash_data($session_flash) != '') ? '<div class="container event_message">' . get_flash_data($session_flash) . '</div>' : '';
            ?>
            <div class="section-title text-center mb-40">
                <h2 class="commonHeading">our price list</h2>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <img src="<?php echo base_url(); ?>/assets/uploads/category/<?php echo $category_name['cat_img']; ?>"
                        alt="Visiting Card">
                </div>
                <div class="col-lg-6 pt-30">
                    <div class="priceTable">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Quality</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                for ($i = 0; $i < count($quality); $i++) {
                                    if ($quality[$i] != '' && $qty[$i] != '' && $price[$i] != '') {
                                        ?>
                                        <tr>
                                            <td><?php echo $quality[$i]; ?></td>
                                            <td><?php echo $qty[$i]; ?></td>
                                            <td><?php echo $price[$i]; ?> &#8377;</td>
                                        </tr>
                                    <?php
                                    }

                                }

                                ?>



                            </tbody>
                        </table>
                        <div class="text-center pt-5">
                            <a href="#" class="theme-btn style-two wow fadeInUp delay-0-4s tableBtn" data-toggle="modal"
                                data-target="#exampleModal">Get a Quote</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php

}
?>







<!-- Price Area end -->

<!-- Work Area start -->
<section class="pb-55 pt-35 rel z-1">
    <div class="container">
        <div class="section-title text-center mb-40">
            <h2 class="commonHeading">Our Work Gallery</h2>
        </div>
        <div class="row">



















            <?php
            foreach ($products as $product) {
                ?>
                <div class="col-lg-3 mb-5 mt-5">
                    <div class="workGallery">
                        <a href="#">
                            <img class="product_img"
                                src="<?php echo base_url(); ?>/assets/uploads/product/<?php echo $product['image']; ?>"
                                alt="gallery">
                        </a>
                        <p><?php echo $product['title']; ?></p>
                    </div>
                </div>


            <?php
            }
            ?>




        </div>
    </div>
</section>
<!-- Work Area end -->
<!-- Call to Action Area start -->
<?php include('brand_page.php'); ?>
<!-- Call to Action Area End -->
<script src="<?php echo base_url() . '/assets/js/category_form.js?v=' . $v; ?>"></script>