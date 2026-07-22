<div class="post d-flex flex-column-fluid" id="kt_post">
   <div id="kt_content_container" class="container">
      <div class="card mb-5 mb-xl-10">
         <div id="kt_account_profile_details" class="collapse show">
            <?php
               $attributes = 'name="settings" id="kt_account_profile_details_form" class="form" enctype="multipart/form-data" novalidate="novalidate"';
               $hidden = array();
               echo form_open(route_to('client_profile_url'), $attributes, $hidden);
               
               ?>
            <div class="card-body borderer-top p-5">
               <h6>Client Credentials</h6>
               <div class="row mb-6">
                  <div class="col-md-4 mb-6">
                     <label class="col-form-label required fw-bold fs-6"><?= lang("Common.email") ?></label>
                     <div class="fv-row">
                        <?php
                           $email_box = [
                               'name' => 'email',
                               'type' => 'text',
                               'class' => 'form-control form-control-lg form-control-solid',
                               'value' => $user_email,
                               'placeholder' => lang("Common.email"),
                               'autofocus' => '',
                           ];
                           echo form_input($email_box);
                           echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('email') . '</span>' : ''; ?>
                     </div>
                  </div>
                  <div class="col-md-4 mb-6">
                     <label class="col-form-label required fw-bold fs-6"><?= lang("Common.password") ?></label>
                     <div class="fv-row">
                        <?php
                           $password_box = [
                               'name' => 'new_password',
                               'type' => 'text',
                               'class' => 'form-control form-control-lg form-control-solid',
                               'value' => $user_pass,
                               'placeholder' => lang("Common.password"),
                               'autofocus' => '',
                           ];
                           echo form_input($password_box);
                           echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('new_password') . '</span>' : ''; ?>
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