<script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>/assets/ckfinder/ckfinder.js"></script>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
		
        <?php
            
			if($network_offer['id']!='')
            {
                $main_title = $network_offer['main_title'];
				$sub_title = $network_offer['sub_title'];
		        $pos1_title = $network_offer['pos1_title']; 
				$pos1_url = $network_offer['pos1_url'];
                $pos1_image = $network_offer['pos1_image'];
				$pos2_title = $network_offer['pos2_title']; 
				$pos2_url = $network_offer['pos2_url'];
				$pos2_image = $network_offer['pos2_image'];
		        $pos3_title = $network_offer['pos3_title']; 
				$pos3_url = $network_offer['pos3_url'];
                $pos3_image = $network_offer['pos3_image'];
				$pos4_title = $network_offer['pos4_title'];
				$pos4_url = $network_offer['pos4_url'];
				$pos4_image = $network_offer['pos4_image'];
		        $pos5_title = $network_offer['pos5_title']; 
				$pos5_url = $network_offer['pos5_url'];
                $pos5_image = $network_offer['pos5_image'];
				$pos6_title = $network_offer['pos6_title']; 
				$pos6_url = $network_offer['pos6_url'];
                $pos6_image = $network_offer['pos6_image'];
                $status = ($network_offer['is_active'] == 'active') ? 'checked="checked"' : '';
            }
            $attributes = 'name="add_pages" id="kt_account_profile_details_form" class="form"  enctype="multipart/form-data" novalidate="novalidate"';
            $hidden     = array();
            echo form_open(route_to('bridge_network_offer_edit_url'), $attributes, $hidden);
        ?>

    
        <div class="card mb-5 mb-xl-10">
			<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="true" aria-controls="kt_account_profile_details">
				<div class="card-title m-0">
					<h3 class="fw-bolder m-0">
                        <?=lang('Common.bridge_network_offer');?>
                    </h3>
				</div>
			</div>
			
			<div id="kt_account_profile_details" class="collapse show">
			
				
				<!-- Start Welcome Section -->
                <div class="card-body borderer-top p-9">
						<div class="row mb-6">
								
						            <div class="col-md-6 mb-6">
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

                                    <div class="col-md-6 mb-6">
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




                                <div class="col-md-12 mb-12 mt-5" >
                                    <h2><?=lang("Common.pos1")?></h2>
								 </div>
						
						
								

                                <div class="col-md-4 mb-4" >
									<label class="col-form-label fw-bold fs-6"><?=lang("Common.image")?></label>
										<div class="fv-row">
											<?php 
												$pos1_image_box = [
													'id'        => 'pos1_image',
													'name'      => 'pos1_image',
													'class'     => 'form-control form-control-lg form-control-solid',
													'type'		=> 'file',
													'accept'    => 'image/*'
												];
												echo form_input($pos1_image_box);
												
												
                                                if($pos1_image!='') 
												{ 
												?>
												<img src="<?php echo base_url().'/assets/uploads/home-section/about/'.$pos1_image; ?>" style="max-width:100px;height:100px;" /> 
												<?php 
												}
                                                
											?>
										</div>
								</div>

								<div class="col-md-4 mb-4">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.title")?></label>
										<div class="fv-row">
											<?php 
													$pos1_title_box = [
														'id' => "pos1_title",
														'name'      => 'pos1_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $pos1_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($pos1_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('pos1_title').'</span>' : ''; 
											?>
										</div>
								</div>

								<div class="col-md-4 mb-4">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
										<div class="fv-row">
											<?php 
													$pos1_url_box = [
														'id' => "pos1_url",
														'name'      => 'pos1_url',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $pos1_url,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($pos1_url_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('pos1_url').'</span>' : ''; 
											?>
										</div>
								</div>

								


                                <div class="col-md-12 mb-12 mt-5" >
                                    <h2><?=lang("Common.pos2")?></h2>
								 </div>
						
					
                                <div class="col-md-4 mb-4" >
									<label class="col-form-label fw-bold fs-6"><?=lang("Common.image")?></label>
										<div class="fv-row">
											<?php 
												$pos2_image_box = [
													'id'        => 'pos2_image',
													'name'      => 'pos2_image',
													'class'     => 'form-control form-control-lg form-control-solid',
													'type'		=> 'file',
													'accept'    => 'image/*'
												];
												echo form_input($pos2_image_box);
												
												
                                                if($pos2_image!='') 
												{ 
												?>
												<img src="<?php echo base_url().'/assets/uploads/home-section/about/'.$pos2_image; ?>" style="max-width:100px;height:100px;" /> 
												<?php 
												}
                                                
											?>
										</div>
								</div>

								<div class="col-md-4 mb-4">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.title")?></label>
										<div class="fv-row">
											<?php 
													$pos2_title_box = [
														'id' => "pos2_title",
														'name'      => 'pos2_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $pos2_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($pos2_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('pos2_title').'</span>' : ''; 
											?>
										</div>
								</div>
								
								<div class="col-md-4 mb-4">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
										<div class="fv-row">
											<?php 
													$pos2_url_box = [
														'id' => "pos2_url",
														'name'      => 'pos2_url',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $pos2_url,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($pos2_url_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('pos2_url').'</span>' : ''; 
											?>
										</div>
								</div>



                                <div class="col-md-12 mb-12 mt-5" >
                                    <h2><?=lang("Common.pos3")?></h2>
								 </div>
						

                                <div class="col-md-4 mb-4" >
									<label class="col-form-label fw-bold fs-6"><?=lang("Common.image")?></label>
										<div class="fv-row">
											<?php 
												$pos3_image_box = [
													'id'        => 'pos3_image',
													'name'      => 'pos3_image',
													'class'     => 'form-control form-control-lg form-control-solid',
													'type'		=> 'file',
													'accept'    => 'image/*'
												];
												echo form_input($pos3_image_box);
												
												
												if($pos3_image!='') 
												{ 
												?>
												<img src="<?php echo base_url().'/assets/uploads/home-section/about/'.$pos3_image; ?>" style="max-width:100px;height:100px;" /> 
												<?php 
												}
                                                
											?>
										</div>
								</div>

								<div class="col-md-4 mb-4">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.title")?></label>
										<div class="fv-row">
											<?php 
													$pos3_title_box = [
														'id' => "pos3_title",
														'name'      => 'pos3_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $pos3_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($pos3_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('pos3_title').'</span>' : ''; 
											?>
										</div>
								</div>

								<div class="col-md-4 mb-4">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
										<div class="fv-row">
											<?php 
													$pos3_url_box = [
														'id' => "pos3_url",
														'name'      => 'pos3_url',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $pos3_url,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($pos3_url_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('pos3_url').'</span>' : ''; 
											?>
										</div>
								</div>

                                <div class="col-md-12 mb-12 mt-5">
                                    <h2><?=lang("Common.pos4")?></h2>
								 </div>
						
						
                                <div class="col-md-4 mb-4" >
									<label class="col-form-label fw-bold fs-6"><?=lang("Common.image")?></label>
										<div class="fv-row">
											<?php 
												$pos4_image_box = [
													'id'        => 'pos4_image',
													'name'      => 'pos4_image',
													'class'     => 'form-control form-control-lg form-control-solid',
													'type'		=> 'file',
													'accept'    => 'image/*'
												];
												echo form_input($pos4_image_box);
												
												
                                                if($pos4_image!='') 
												{ 
												?>
												<img src="<?php echo base_url().'/assets/uploads/home-section/about/'.$pos4_image; ?>" style="max-width:100px;height:100px;" /> 
												<?php 
												}
											?>

										</div>
								</div>

								<div class="col-md-4 mb-4">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.title")?></label>
										<div class="fv-row">
											<?php 
													$pos4_title_box = [
														'id' => "pos4_title",
														'name'      => 'pos4_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $pos4_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($pos4_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('pos4_title').'</span>' : ''; 
											?>
										</div>
								</div>	
								
								<div class="col-md-4 mb-4">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
										<div class="fv-row">
											<?php 
													$pos4_url_box = [
														'id' => "pos4_url",
														'name'      => 'pos4_url',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $pos4_url,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($pos4_url_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('pos4_url').'</span>' : ''; 
											?>
										</div>
								</div>


                                <div class="col-md-12 mb-12 mt-5" >
                                    <h2><?=lang("Common.pos5")?></h2>
								 </div>
						
						
								

                                <div class="col-md-4 mb-4" >
									<label class="col-form-label fw-bold fs-6"><?=lang("Common.image")?></label>
										<div class="fv-row">
											<?php 
												$pos5_image_box = [
													'id'        => 'pos5_image',
													'name'      => 'pos5_image',
													'class'     => 'form-control form-control-lg form-control-solid',
													'type'		=> 'file',
													'accept'    => 'image/*'
												];
												echo form_input($pos5_image_box);
												
												
												if($pos5_image!='') 
												{ 
												?>
												<img src="<?php echo base_url().'/assets/uploads/home-section/about/'.$pos5_image; ?>" style="max-width:100px;height:100px;" /> 
												<?php 
												}
                                                
											?>
										</div>
								</div>

								<div class="col-md-4 mb-4">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.title")?></label>
										<div class="fv-row">
											<?php 
													$pos5_title_box = [
														'id' => "pos5_title",
														'name'      => 'pos5_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $pos5_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($pos5_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('title').'</span>' : ''; 
											?>
										</div>
								</div>

								<div class="col-md-4 mb-4">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
										<div class="fv-row">
											<?php 
													$pos5_url_box = [
														'id' => "pos5_url",
														'name'      => 'pos5_url',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $pos5_url,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($pos5_url_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('pos5_url').'</span>' : ''; 
											?>
										</div>
								</div>


                                <div class="col-md-12 mb-12 mt-5" >
                                    <h2><?=lang("Common.pos6")?></h2>
								 </div>
						
						
								

                                <div class="col-md-4 mb-4" >
									<label class="col-form-label fw-bold fs-6"><?=lang("Common.image")?></label>
										<div class="fv-row">
											<?php 
												$pos6_image_box = [
													'id'        => 'pos6_image',
													'name'      => 'pos6_image',
													'class'     => 'form-control form-control-lg form-control-solid',
													'type'		=> 'file',
													'accept'    => 'image/*'
												];
												echo form_input($pos6_image_box);
												
												
                                                if($pos6_image!='') 
												{ 
												?>
												<img src="<?php echo base_url().'/assets/uploads/home-section/about/'.$pos6_image; ?>" style="max-width:100px;height:100px;" /> 
												<?php 
												}
                                                
											?>
										</div>
								</div>

								<div class="col-md-4 mb-4">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.title")?></label>
										<div class="fv-row">
											<?php 
													$pos6_title_box = [
														'id' => "pos6_title",
														'name'      => 'pos6_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $pos6_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($pos6_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('pos6_title').'</span>' : ''; 
											?>
										</div>
								</div>


								<div class="col-md-4 mb-4">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
										<div class="fv-row">
											<?php 
													$pos6_url_box = [
														'id' => "pos6_url",
														'name'      => 'pos6_url',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $pos6_url,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($pos6_url_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('pos6_url').'</span>' : ''; 
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