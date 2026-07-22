<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#"
                 aria-expanded="true" aria-controls="kt_account_profile_details">
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0"><?= ($slug == '') ? lang('Common.add_category') : lang('Common.edit_category') ?></h3>
                </div>
            </div>
            <div id="kt_account_profile_details" class="collapse show">
                <?php


                if ($slug == '') 
                {

                    $title = set_value('title');
                    $image = set_value('image');
                    $cat_img = set_value('cat_img');
                    $order_by = set_value('order_by');
                    $status = 'checked="checked"';

                    $attributes = 'name="add_banner" id="kt_account_profile_details_form" class="form" enctype="multipart/form-data" novalidate="novalidate"';
                    $hidden = array();
                    echo form_open(route_to('category_add_url'), $attributes, $hidden);
                } else 
                {
                   
                    $title = $category_data['title'];
                    $image = $category_data['image'];
                    $cat_img = $category_data['cat_img'];

                    $status = ($category_data['is_active'] == 'active') ? 'checked="checked"' : '';
                    $attributes = 'name="edit_category" id="kt_account_profile_details_form" class="form" enctype="multipart/form-data" novalidate="novalidate"';
                    $hidden = array();
                    echo form_open(route_to('category_edit_url', $category_data['id']), $attributes, $hidden);
                }
                ?>
                <div class="card-body borderer-top p-9">
                    <div class="row mb-6">
                        <div class="col-md-12 mb-12">
                            <label class="col-form-label fw-bold fs-6"><?= lang("Common.title") ?></label>
                            <div class="fv-row">
                                <?php
                                $title_box = [
                                    'name' => 'title',
                                    'class' => 'form-control form-control-lg form-control-solid',
                                    'value' => $title,
                                    'placeholder' => lang("Common.title"),
                                    'autofocus' => '',
                                ];
                                echo form_input($title_box);
                                echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('title') . '</span>' : ''; ?>
                            </div>
                        </div>

                        

                        <div class="col-md-12 mb-12">
                            <label class="col-form-label required fw-bold fs-6"><?= lang("Common.image") ?></label>
                            <div class="fv-row">
                                <?php
                                $image_box = [
                                    'name' => 'image',
                                    'class' => 'form-control form-control-lg form-control-solid',
                                    'type' => 'file',
                                    'accept' => 'image/*'
                                ];
                                echo form_input($image_box);
                                echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('image') . '</span>' : ''; 
                                if($image) 
                                { 
                                ?>
                                <img src="<?php echo base_url().'/assets/uploads/category/'.$image; ?>" style="width:150px;height:150px;" /> 
                                <?php
                                }
                                
                                ?>
                            </div>
                            <br/>
                            
                        </div>



                        <div class="col-md-12 mb-12">
                            <label class="col-form-label required fw-bold fs-6"><?= lang("Common.cat_img") ?></label>
                            <div class="fv-row">
                                <?php
                                $cat_image_box = [
                                    'name' => 'cat_img',
                                    'class' => 'form-control form-control-lg form-control-solid',
                                    'type' => 'file',
                                    'accept' => 'image/*'
                                ];
                                echo form_input($cat_image_box);
                                echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('cat_image') . '</span>' : ''; 
                                if($cat_img) 
                                { 
                                ?>
                                <img src="<?php echo base_url().'/assets/uploads/category/'.$cat_img; ?>" style="width:150px;height:150px;" /> 
                                <?php
                                }
                                
                                ?>
                            </div>
                            <br/>
                            
                        </div>

                        <div class="col-md-12 mb-12">
                            <h3>Price Quotation</h3>
						</div>

                        <div id="add_data">
                            <?php
                             if($slug !='')
                             {
                                $quality = explode(",",$category_data['quality']);
								$qty = explode(",",$category_data['qty']);
                                $price = explode(",",$category_data['price']);
						     
                                    $i=1;
                                    for($i=0;$i<count($quality);$i++)
                                    {
                                    ?>
                                        <div class="row" id="dynamic<?php echo $i; ?>">	
                                            <div class="col-lg-3 mb-5">
                                                <div class="fv-row">
                                                    <input type="text" name="quality[]" class="form-control form-control-lg" placeholder="Quality" value="<?php echo $quality[$i]; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-5">
                                                <div class="fv-row">
                                                <input type="text" name="qty[]" class="form-control form-control-lg" placeholder="QTY" value="<?php echo $qty[$i]; ?>">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 mb-5">
                                                <div class="fv-row">
                                                <input type="text" name="price[]" class="form-control form-control-lg" placeholder="Price" value="<?php echo $price[$i]; ?>">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 mb-2">
                                                        <div class="fv-row">
                                                        <button type="button" id="<?php echo $i; ?>"  class="btn btn-danger removeBtn remove_dynamic_data">Remove</button>
                                                        </div>
                                            </div>
                                            
                                        </div>

                                    <?php   
                                    }
                                    $i++;
                                     ?>
                                 <?php   
                             }
                             else
                             {
                             ?>
                             <div class="row">	
									<div class="col-lg-3 mb-5">
										<div class="fv-row">
											<input type="text" name="quality[]" class="form-control form-control-lg" placeholder="Quality">
										</div>
									</div>
									<div class="col-lg-3 mb-5">
										<div class="fv-row">
										<input type="text" name="qty[]" class="form-control form-control-lg" placeholder="QTY">
										</div>
									</div>

                                    <div class="col-lg-3 mb-5">
										<div class="fv-row">
										<input type="text" name="price[]" class="form-control form-control-lg" placeholder="Price">
										</div>
									</div>
									
								</div>
                             <?php   
                             }
                            ?>
                                
                        
                        </div>

                        <div class="col-lg-12 mb-12">
							<div class="fv-row">
							<button type="button" id="add" class="btn btn-primary ml-3">Add More</button>
							</div>
						</div>	

                       

                        <div class="col-md-6 mb-6">
                            <label class="col-lg-2 col-form-label fw-bold fs-6"><?= lang("Common.status") ?></label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch fv-row">
                                    <input class="form-check-input w-45px h-30px" type="checkbox" id="status"
                                           name="is_active" value="1" <?= $status ?> />
                                    <label class="form-check-label" for="status"></label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset"
                                class="btn btn-white btn-active-light-primary me-2"><?= lang('Common.discard') ?></button>
                        <button type="submit" class="btn btn-primary"
                                id="kt_account_profile_details_submit"><?= lang('Common.save') ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">
        .k-treeview {
            display: none;
        }
    </style>
