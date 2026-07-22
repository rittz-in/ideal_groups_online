<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
		<div class="card mb-5 mb-xl-10">
			<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="true" aria-controls="kt_account_profile_details">
				<div class="card-title m-0">
					<h3 class="fw-bolder m-0"><?=($slug == '')?lang('Common.add_user'):lang('Common.edit_user')?></h3>
				</div>
			</div>
			<div id="kt_account_profile_details" class="collapse show">
				<?php


				if($slug == ''){
					$email = set_value('email');
					$first_name = set_value('first_name');
					$last_name = set_value('last_name');
					$gender = set_value('gender');
					$mobile = set_value('mobile');
					$status = 'checked="checked"';

					$attributes = 'name="add_user" id="kt_account_profile_details_form" class="form" enctype="multipart/form-data" novalidate="novalidate"';
                	$hidden     = array();
                	echo form_open(route_to('user_add_url'), $attributes, $hidden);
				} else {
					$email = $user_data['email'];
					$first_name = $user_data['first_name'];
					$last_name = $user_data['last_name'];
					$gender = $user_data['gender'];
					$mobile = $user_data['mobile'];
					$status = ($user_data['status'] == '1') ? 'checked="checked"' : '';

					$attributes = 'name="edit_user" id="kt_account_profile_details_form" class="form" enctype="multipart/form-data" novalidate="novalidate"';
                	$hidden     = array();
                	echo form_open(route_to('user_edit_url', $user_data['encryption_admin_user_id']), $attributes, $hidden);
				}
                ?>
					<div class="card-body border-top p-9">
						<div class="row mb-6">

							<div class="col-md-6 mb-6">
								<label class="col-form-label required fw-bold fs-6"><?=lang("Common.email")?></label>
								<div class="fv-row">
									<?php 
									$email_box = [
										'name'      => 'email',
									    'class'     => 'form-control form-control-lg form-control-solid',
									    'value'     => $email,
									    'placeholder' => lang("Common.email"),
									    'autofocus' => '',
									];
									echo form_input($email_box);
									echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('email').'</span>' : ''; ?>
								</div>
							</div>
							<div class="col-md-6 mb-6">
								<?php if ($slug == ''): ?>
									<label class="col-form-label required fw-bold fs-6"><?=lang("Common.password")?></label>
									<div class="fv-row">
										<?php 
										$password_box = [
											'name'      => 'password',
										    'class'     => 'form-control form-control-lg form-control-solid',
										    'value'     => $password,
										    'placeholder' => lang("Common.password"),
										    'type' => 'password',
										];
										echo form_input($password_box);
										echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('password').'</span>' : ''; ?>
									</div>
								<?php endif ?>
							</div>
							<div class="col-md-6 mb-6">
								<label class="col-form-label required fw-bold fs-6"><?=lang("Common.first_name")?></label>
								<div class="fv-row">
									<?php 
									$first_name_box = [
										'name'      => 'first_name',
									    'class'     => 'form-control form-control-lg form-control-solid',
									    'value'     => $first_name,
									    'placeholder' => lang("Common.first_name"),
									    'autofocus' => '',
									];
									echo form_input($first_name_box);
									echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('first_name').'</span>' : ''; ?>
								</div>
							</div>
							<div class="col-md-6 mb-6">
								<label class="col-form-label required fw-bold fs-6"><?=lang("Common.last_name")?></label>
								<div class="fv-row">
									<?php 
									$last_name_box = [
										'name'      => 'last_name',
									    'class'     => 'form-control form-control-lg form-control-solid',
									    'value'     => $last_name,
									    'placeholder' => lang("Common.last_name"),
									    'autofocus' => '',
									];
									echo form_input($last_name_box);
									echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('last_name').'</span>' : ''; ?>
								</div>
							</div>

							<div class="col-md-6 mb-6">
								<label class="col-form-label required fw-bold fs-6"><?=lang("Common.gender")?></label>
								<div class="fv-row">
									<?php 
									$options = [
										'Male'      => 'Male',
									    'Female'     => 'Female',
									];
									echo form_dropdown('gender', $options, $gender,'class="form-control form-control-lg form-control-solid"');
									echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('gender').'</span>' : ''; ?>
								</div>
							</div>
							<div class="col-md-6 mb-6">
								<label class="col-form-label required fw-bold fs-6"><?=lang("Common.mobile")?></label>
								<div class="fv-row">
									<?php 
									$mobile_box = [
										'name'      => 'mobile',
									    'class'     => 'form-control form-control-lg form-control-solid',
									    'value'     => $mobile,
									    'placeholder' => lang("Common.mobile"),
									    'autofocus' => '',
									];
									echo form_input($mobile_box);
									echo (isset($validation)) ? '<span class="d-block invalid-feedback">'.$validation->getError('mobile').'</span>' : ''; ?>
								</div>
							</div>

						</div>
						<div class="row mb-6">
							<label class="col-lg-2 col-form-label fw-bold fs-6"><?=lang("Common.status")?></label>
							<div class="col-lg-8 d-flex align-items-center">
								<div class="form-check form-check-solid form-switch fv-row">
									<input class="form-check-input w-45px h-30px" type="checkbox" id="status" name="status" value="1" <?=$status?> />
									<label class="form-check-label" for="status"></label>
								</div>
							</div>
						</div>
						<div>
							<label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
							<div class="table-responsive">
								<table class="table  table-row-dashed fs-6 gy-5">
									<tbody class="text-gray-600 fw-bold">
										<?php foreach ($_admin_links as $_admin_linkskey => $_admin_linksvalue){
											if(isset($_admin_linksvalue['items']) && count($_admin_linksvalue['items']) > 0){
												echo '<tr>';
													echo '<td class="text-gray-800" width="20%">'.$_admin_linksvalue['text'].'</td>';
													echo '<td>
														<div class="">';
															foreach ($_admin_linksvalue['items'] as $key => $value) {
																$checked = ($value['check'] == 'checked') ? 'checked' : '';
																echo '<label class="form-check mb-2 form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
																	<input class="form-check-input" type="checkbox" '.$checked.' value="'.$value['id'].'" name="role_resources[]">
																	<span class="form-check-label">'.$value['text'].'</span>
																</label>';
															}
														echo '</div>
													</td>';
												echo '</tr>';	
											}
										} ?>
									</tbody>
								</table>
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
	</div>
</div>

<style type="text/css">
	.k-treeview span.k-in{
		display: none;
	}
</style>
