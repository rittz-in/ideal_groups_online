<div class="post d-flex flex-column-fluid" id="kt_post">
   <div id="kt_content_container" class="container">
      <div class="card mb-5 mb-xl-10">
         <div id="kt_account_profile_details" class="collapse show">
            <?php
               /*print_r($settings_data);
               die();*/
               
               $website_title = $settings_data['website_title'] ? $settings_data['website_title'] : "";
               $email = $settings_data['email'] ? $settings_data['email'] : "";
               $logo_url = $settings_data['logo_url'];
               $image = $settings_data['image'];
               $phone = $settings_data['contact'] ? $settings_data['contact'] : "";
               $address = $settings_data['address'] ? $settings_data['address'] : "";
               $facebook = $settings_data['facebook'] ? $settings_data['facebook'] : "";
               $twitter = $settings_data['twitter'] ? $settings_data['twitter'] : "";
               $youtube = $settings_data['youtube'] ? $settings_data['youtube'] : "";
               $instagram = $settings_data['instagram'] ? $settings_data['instagram'] : "";
               $copyright = $settings_data['copyright'] ? $settings_data['copyright'] : "";
               $prayer_request_email = $settings_data['prayer_request_email'] ? $settings_data['prayer_request_email'] : "";
               $contact_form = $settings_data['contact_form'] ? $settings_data['contact_form'] : "";
               
               $attributes = 'name="settings" id="kt_account_profile_details_form" class="form" enctype="multipart/form-data" novalidate="novalidate"';
               $hidden = array();
               echo form_open(route_to('reset_password_url'), $attributes, $hidden);
               
               ?>
            <div class="card-body borderer-top p-5">
               <div class="row mb-6">
                  <div class="col-md-4 mb-6">
                     <label class="col-form-label required fw-bold fs-6"><?= lang("Common.old_password") ?></label>
                     <div class="fv-row">
                        <?php
                           $old_password_box = [
                               'name' => 'old_password',
                               'type' => 'text',
                               'class' => 'form-control form-control-lg form-control-solid',
                               'value' => $old_password,
                               'placeholder' => lang("Common.old_password"),
                               'autofocus' => '',
                           ];
                           echo form_input($old_password_box);
                           echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('old_password') . '</span>' : ''; ?>
                     </div>
                  </div>
                  <div class="col-md-4 mb-6">
                     <label class="col-form-label required fw-bold fs-6"><?= lang("Common.new_password") ?></label>
                     <div class="fv-row">
                        <?php
                           $new_password_box = [
                               'name' => 'new_password',
                               'type' => 'text',
                               'class' => 'form-control form-control-lg form-control-solid',
                               'value' => $new_password,
                               'placeholder' => lang("Common.new_password"),
                               'autofocus' => '',
                           ];
                           echo form_input($new_password_box);
                           echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('new_password') . '</span>' : ''; ?>
                     </div>
                  </div>
                  <div class="col-md-4 mb-6">
                     <label class="col-form-label required fw-bold fs-6"><?= lang("Common.confirm_password") ?></label>
                     <div class="fv-row">
                        <?php
                           $confirm_password_box = [
                               'name' => 'confirm_password',
                               'type' => 'text',
                               'class' => 'form-control form-control-lg form-control-solid',
                               'value' => $confirm_password,
                               'placeholder' => lang("Common.confirm_password"),
                               'autofocus' => '',
                           ];
                           echo form_input($confirm_password_box);
                           echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('confirm_password') . '</span>' : ''; ?>
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