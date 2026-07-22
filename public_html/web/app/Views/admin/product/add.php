<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#"
                 aria-expanded="true" aria-controls="kt_account_profile_details">
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0"><?= ($slug == '') ? lang('Common.add_product') : lang('Common.edit_product') ?></h3>
                </div>
            </div>
            <div id="kt_account_profile_details" class="collapse show">
                <?php


                if ($slug == '') 
                {

                    $title = set_value('title');
                    $image = set_value('image');
                    $order_by = set_value('order_by');
                    $status = 'checked="checked"';

                    $attributes = 'name="add_banner" id="kt_account_profile_details_form" class="form" enctype="multipart/form-data" novalidate="novalidate"';
                    $hidden = array();
                    echo form_open(route_to('product_add_url'), $attributes, $hidden);
                } else 
                {
                   
                    $title = $product_data['title'];
                    $image = $product_data['image'];
                    $image = $product_data['image'];
                    $category_name = $product_data['category_id'];

                    
                  

                    $status = ($product_data['is_active'] == 'active') ? 'checked="checked"' : '';
                    $attributes = 'name="edit_category" id="kt_account_profile_details_form" class="form" enctype="multipart/form-data" novalidate="novalidate"';
                    $hidden = array();
                    echo form_open(route_to('product_edit_url', $product_data['id']), $attributes, $hidden);
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
                            <label class="col-form-label fw-bold fs-6"><?= lang("Common.select_category") ?></label>
                            <div class="fv-row">

                            <?php 
								if($category_data == "no")
								{
								   $options = [
                                    '' => 'Select a Category',
									];	
										
									echo form_dropdown('category_id', $options,$category_name,'class="form-control form-control-lg form-control-solid" id="event_category_id"');
									echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('category').'</span>' : ''; 
								}
								else
								{
									foreach ($categories as $category)
									 {
										$options[$category['id']] = $category['title'];
									 }
									echo form_dropdown('category_id', $options, $category_name,'class="form-control form-control-lg form-control-solid" id="event_category_id"');
									
								}	
								
								 ?>
                        
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
                                <img src="<?php echo base_url().'/assets/uploads/product/'.$image; ?>" style="width:150px;height:150px;" /> 
                                <?php
                                }
                                
                                ?>
                            </div>
                            <br/>
                            
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
