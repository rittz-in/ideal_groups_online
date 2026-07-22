<script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>/assets/ckfinder/ckfinder.js"></script>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
		
        <?php
            
			if($about_bridge_network['id']!='')
            {
                $main_title = $about_bridge_network['main_title'];
				$sub_title = $about_bridge_network['sub_title'];
		        $description = $about_bridge_network['description'];
				$image = $about_bridge_network['image'];
                $button_name = $about_bridge_network['button_name'];
				$url = $about_bridge_network['url'];
		        $status = ($about_bridge_network['is_active'] == 'active') ? 'checked="checked"' : '';
            }
            $attributes = 'name="add_pages" id="kt_account_profile_details_form" class="form"  enctype="multipart/form-data" novalidate="novalidate"';
            $hidden     = array();
            echo form_open(route_to('about_bridge_network_edit_url'), $attributes, $hidden);
        ?>

    
        <div class="card mb-5 mb-xl-10">
			<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="true" aria-controls="kt_account_profile_details">
				<div class="card-title m-0">
					<h3 class="fw-bolder m-0">
                        <?=lang('Common.about_bridge_network');?>
                    </h3>
				</div>
			</div>
			
			<div id="kt_account_profile_details" class="collapse show">
			
				
				<!-- Start Welcome Section -->
                <div class="card-body borderer-top p-9">
						<div class="row mb-6">
								
						<div class="col-md-12 mb-12">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.main_title")?></label>
										<div class="fv-row">
											<?php 
													$main_title_box = [
														'id' => "main_title",
														'name'      => 'main_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $main_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($main_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('main_title').'</span>' : ''; 
											?>
										</div>
								</div>
						
						
								<div class="col-md-12 mb-12">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.sub_title")?></label>
										<div class="fv-row">
											<?php 
													$sub_title_box = [
														'id' => "sub_title",
														'name'      => 'sub_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $sub_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($sub_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('sub_title').'</span>' : ''; 
											?>
										</div>
								</div>

                                <div class="col-md-12 mb-12" >
									<label class="col-form-label fw-bold fs-6"><?=lang("Common.description")?></label>
									<div id="description_box"></div>
									<textarea name="description" id="description" style="height: 0;visibility: hidden;">
                                    <?php echo $description; ?></textarea>
                                    <?php 
                                    echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('description').'</span>' : ''; 
                                    ?>
                                    
									
								</div>


                                <div class="col-md-12 mb-12" >
									<label class="col-form-label fw-bold fs-6"><?=lang("Common.image")?></label>
										<div class="fv-row">
											<?php 
												$image_box = [
													'id'        => 'image',
													'name'      => 'image',
													'class'     => 'form-control form-control-lg form-control-solid',
													'type'		=> 'file',
													'accept'    => 'image/*'
												];
												echo form_input($image_box);
												
												
                                                if($image!='') 
												{ 
												?>
												<img src="<?php echo base_url().'/assets/uploads/home-section/about/'.$image; ?>" style="max-width:200px;height:200px;" /> 
												<?php 
												}
                                                
											?>
										</div>
								</div>

                                <div class="col-md-12 mb-12">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.button_name")?></label>
										<div class="fv-row">
											<?php 
													$button_name_box = [
														'id' => "button_name",
														'name'      => 'button_name',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $button_name,
														'autofocus' => '',
													];
													echo form_input($button_name_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('button_name').'</span>' : ''; 
											?>
										</div>
								</div>


                                <div class="col-md-12 mb-12">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
										<div class="fv-row">
											<?php 
													$url_box = [
														'id' => "url",
														'name'      => 'url',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $url,
														'autofocus' => '',
													];
													echo form_input($url_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('url').'</span>' : ''; 
											?>
										</div>
								</div>

                                <div class="col-md-12 mb-12">
                                    <label class="col-lg-2 col-form-label fw-bold fs-6"><?=lang("Common.status")?></label>
                                    <div class="col-lg-8 d-flex align-items-center">
                                        <div class="form-check form-check-solid form-switch fv-row">
                                            <input class="form-check-input w-45px h-30px" type="checkbox" id="status" name="is_active" value="1" <?=$status?> />
                                            <label class="form-check-label" for="status"></label>
                                        </div>
                                    </div>
                                </div>

								

      							
								<div class="clearfix"></div>

						</div>
								
				</div>
				
			</div>
						
					<div class="card-footer d-flex justify-content-end py-6 px-9">
						<button type="reset" class="btn btn-white btn-active-light-primary me-2"><?=lang('Common.discard')?></button>
						<button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit"><?=lang('Common.save')?></button>
					</div>
								
								
						


        <?php echo form_close(); ?>
	</div>
    
</div>

<style type="text/css">
	.k-treeview {
		display: none;
	}
</style>


<script type="text/javascript">
	var obj = {'description':'<?=$description?>', 'slug': '<?=$slug?>'};
</script>