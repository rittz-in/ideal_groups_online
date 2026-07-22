<script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>/assets/ckfinder/ckfinder.js"></script>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
		
        <?php
            
			if($bridge_network['id']!='')
            {
                $main_title = $bridge_network['main_title'];
				$description = $bridge_network['description'];
		        $b_title = $bridge_network['b_title'];
                $b_url = $bridge_network['b_url'];
                $r_title = $bridge_network['r_title'];
                $r_url = $bridge_network['r_url'];
                $i_title = $bridge_network['i_title'];
                $i_url = $bridge_network['i_url'];
                $d_title = $bridge_network['d_title'];
                $d_url = $bridge_network['d_url'];
                $g_title = $bridge_network['g_title'];
                $g_url = $bridge_network['g_url'];
                $e_title = $bridge_network['e_title'];
                $e_url = $bridge_network['e_url'];
                $status = ($bridge_network['is_active'] == 'active') ? 'checked="checked"' : '';
            }
            $attributes = 'name="add_pages" id="kt_account_profile_details_form" class="form"  enctype="multipart/form-data" novalidate="novalidate"';
            $hidden     = array();
            echo form_open(route_to('bridge_network_edit_url'), $attributes, $hidden);
        ?>

    
        <div class="card mb-5 mb-xl-10">
			<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="true" aria-controls="kt_account_profile_details">
				<div class="card-title m-0">
					<h3 class="fw-bolder m-0">
                        <?=lang('Common.bridge_network');?>
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
						
						
								

                                <div class="col-md-12 mb-12" >
									<label class="col-form-label fw-bold fs-6"><?=lang("Common.description")?></label>
									<div id="description_box"></div>
									<textarea name="description" id="description" style="height: 0;visibility: hidden;">
                                    <?php echo $description; ?></textarea>
                                    <?php 
                                    echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('description').'</span>' : ''; 
                                    ?>
                              	</div>

                                  
										<div class="col-md-6">
                                            <label class="col-form-label required fw-bold fs-6"><?=lang("Common.title")?></label>
                                            <div class="fv-row">
                                                <?php 
                                                        $b_title_box = [
                                                            'id' => "b_title",
                                                            'name'      => 'b_title',
                                                            'class'     => 'form-control form-control-lg form-control-solid',
                                                            'value'     => $b_title,
                                                            'placeholder' => '',
                                                            'autofocus' => '',
                                                        ];
                                                        echo form_input($b_title_box);
                                                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('b_title').'</span>' : ''; 
                                                ?>
                                            </div>          

                                        </div>

                                        <div class="col-md-6">
                                            <label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
                                            <div class="fv-row">
                                                <?php 
                                                        $b_url_box = [
                                                            'id' => "b_url",
                                                            'name'      => 'b_url',
                                                            'class'     => 'form-control form-control-lg form-control-solid',
                                                            'value'     => $b_url,
                                                            'placeholder' => '',
                                                            'autofocus' => '',
                                                        ];
                                                        echo form_input($b_url_box);
                                                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('b_url').'</span>' : ''; 
                                                ?>
                                            </div>          

                                        </div>               


								

                                <div class="col-md-6 mb-6">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.title")?></label>
										<div class="fv-row">
											<?php 
													$r_title_box = [
														'id' => "r_title",
														'name'      => 'r_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $r_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($r_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('r_title').'</span>' : ''; 
											?>
										</div>
								</div>

                                <div class="col-md-6">
                                    <label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
                                    <div class="fv-row">
                                        <?php 
                                                $r_url_box = [
                                                    'id' => "r_url",
                                                    'name'      => 'r_url',
                                                    'class'     => 'form-control form-control-lg form-control-solid',
                                                    'value'     => $r_url,
                                                    'placeholder' => '',
                                                    'autofocus' => '',
                                                ];
                                                echo form_input($r_url_box);
                                                echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('r_url').'</span>' : ''; 
                                        ?>
                                    </div>          

                                </div>  



                                <div class="col-md-6 mb-6">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.title")?></label>
										<div class="fv-row">
											<?php 
													$i_title_box = [
														'id' => "i_title",
														'name'      => 'i_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $i_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($i_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('i_title').'</span>' : ''; 
											?>
										</div>
								</div>

                                <div class="col-md-6">
                                    <label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
                                    <div class="fv-row">
                                        <?php 
                                                $i_url_box = [
                                                    'id' => "i_url",
                                                    'name'      => 'i_url',
                                                    'class'     => 'form-control form-control-lg form-control-solid',
                                                    'value'     => $i_url,
                                                    'placeholder' => '',
                                                    'autofocus' => '',
                                                ];
                                                echo form_input($i_url_box);
                                                echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('i_url').'</span>' : ''; 
                                        ?>
                                    </div>          

                                </div> 

                                <div class="col-md-6 mb-6">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.title")?></label>
										<div class="fv-row">
											<?php 
													$d_title_box = [
														'id' => "d_title",
														'name'      => 'd_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $d_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($d_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('d_title').'</span>' : ''; 
											?>
										</div>
								</div>

                                <div class="col-md-6">
                                    <label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
                                    <div class="fv-row">
                                        <?php 
                                                $d_url_box = [
                                                    'id' => "d_url",
                                                    'name'      => 'd_url',
                                                    'class'     => 'form-control form-control-lg form-control-solid',
                                                    'value'     => $d_url,
                                                    'placeholder' => '',
                                                    'autofocus' => '',
                                                ];
                                                echo form_input($d_url_box);
                                                echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('d_url').'</span>' : ''; 
                                        ?>
                                    </div>          

                                </div>                   





                                <div class="col-md-6 mb-6">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.title")?></label>
										<div class="fv-row">
											<?php 
													$g_title_box = [
														'id' => "g_title",
														'name'      => 'g_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $g_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($g_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('g_title').'</span>' : ''; 
											?>
										</div>
								</div>

                                <div class="col-md-6">
                                    <label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
                                    <div class="fv-row">
                                        <?php 
                                                $g_url_box = [
                                                    'id' => "g_url",
                                                    'name'      => 'g_url',
                                                    'class'     => 'form-control form-control-lg form-control-solid',
                                                    'value'     => $g_url,
                                                    'placeholder' => '',
                                                    'autofocus' => '',
                                                ];
                                                echo form_input($g_url_box);
                                                echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('g_url').'</span>' : ''; 
                                        ?>
                                    </div>          

                                </div> 


                                <div class="col-md-6 mb-6">
										<label class="col-form-label required fw-bold fs-6"><?=lang("Common.title")?></label>
										<div class="fv-row">
											<?php 
													$e_title_box = [
														'id' => "e_title",
														'name'      => 'e_title',
														'class'     => 'form-control form-control-lg form-control-solid',
														'value'     => $e_title,
														'placeholder' => '',
														'autofocus' => '',
													];
													echo form_input($e_title_box);
													echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('e_title').'</span>' : ''; 
											?>
										</div>
								</div>

                                <div class="col-md-6">
                                    <label class="col-form-label required fw-bold fs-6"><?=lang("Common.url")?></label>
                                    <div class="fv-row">
                                        <?php 
                                                $e_url_box = [
                                                    'id' => "e_url",
                                                    'name'      => 'e_url',
                                                    'class'     => 'form-control form-control-lg form-control-solid',
                                                    'value'     => $e_url,
                                                    'placeholder' => '',
                                                    'autofocus' => '',
                                                ];
                                                echo form_input($e_url_box);
                                                echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('e_url').'</span>' : ''; 
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