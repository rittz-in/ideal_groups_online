<script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>/assets/ckfinder/ckfinder.js"></script>
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
            echo form_open(route_to('settings_add_url'), $attributes, $hidden);
            
            ?>
         <div class="card-body borderer-top p-9">
            <div class="row mb-6">
               <div class="col-md-6 mb-6">
                  <label class="col-form-label required fw-bold fs-6"><?= lang("Common.website_title") ?></label>
                  <div class="fv-row">
                     <?php
                        $website_title_box = [
                            'name' => 'website_title',
                            'type' => 'text',
                            'class' => 'form-control form-control-lg form-control-solid',
                            'value' => $website_title,
                            'placeholder' => lang("Common.website_title"),
                            'autofocus' => '',
                        ];
                        echo form_input($website_title_box);
                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('title') . '</span>' : ''; ?>
                  </div>
               </div>
               <div class="col-md-6 mb-6">
                  <label class="col-form-label fw-bold fs-6"><?= lang("Common.logo") ?></label>
                  <div class="fv-row">
                     <?php
                        $logo_box = [
                            'name' => 'logo',
                            'class' => 'form-control form-control-lg form-control-solid',
                            'type' => 'file',
                            'accept' => 'image/*'
                        ];
                        echo form_input($logo_box);
                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('logo') . '</span>' : ''; ?>
                  </div>
                  <br/>
                  <?php
                     if ($logo_url != "") {
                         $logo_box = [
                             'name' => 'logo',
                             'class' => 'form-control form-control-lg form-control-solid',
                             'type' => 'hidden',
                             'value' => $logo,
                             'placeholder' => lang("Common.logo"),
                             'autofocus' => '',
                         ];
                         echo form_input($logo_box);
                         echo '<img class="h-40px" src="' . $logo_url . '" alt="">';
                     }
                     ?>
               </div>
               <div class="clearfix"></div>
               <hr class="mb30"/>
               <h4>Contact Details</h4>
               <div class="col-md-6 mb-6">
                  <label class="col-form-label required fw-bold fs-6"><?= lang("Common.email") ?></label>
                  <div class="fv-row">
                     <?php
                        $email_box = [
                            'name' => 'email',
                            'type' => 'email',
                            'class' => 'form-control form-control-lg form-control-solid',
                            'value' => $email,
                            'placeholder' => lang("Common.email"),
                            'autofocus' => '',
                        ];
                        echo form_input($email_box);
                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('title') . '</span>' : ''; ?>
                  </div>
               </div>
               <div class="col-md-6 mb-6">
                  <label class="col-form-label required fw-bold fs-6"><?= lang("Common.phone") ?></label>
                  <div class="fv-row">
                     <?php
                        $phone_box = [
                            'name' => 'phone',
                            'class' => 'form-control form-control-lg form-control-solid',
                            'type' => 'text',
                            'value' => $phone,
                            'placeholder' => lang("Common.phone"),
                            'autofocus' => '',
                        ];
                        echo form_input($phone_box);
                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('phone') . '</span>' : ''; ?>
                  </div>
               </div>
               <div class="col-md-12 mb-12">
                  <label class="col-form-label fw-bold fs-6"><?= lang("Common.address") ?></label>
                  <div class="fv-row">
                     <?php
                        $address_box = [
                            'name' => 'address',
                            'class' => 'form-control form-control-lg form-control-solid',
                            'value' => $address,
                            'rows' => 4,
                            'placeholder' => lang("Common.address"),
                            'autofocus' => '',
                            'id' => 'address'
                        ];
                        echo form_textarea($address_box);
                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('address') . '</span>' : ''; ?>
                  </div>
               </div>
               <div class="clearfix"></div>
               <hr class="mt30 mb30"/>
               <h4>Social Media Links</h4>
               <div class="col-md-6 mb-6">
                  <label class="col-form-label fw-bold fs-6"><?= lang("Common.facebook") ?></label>
                  <div class="fv-row">
                     <?php
                        $facebook_box = [
                            'name' => 'facebook',
                            'class' => 'form-control form-control-lg form-control-solid',
                            'value' => $facebook,
                            'placeholder' => lang("Common.facebook"),
                            'autofocus' => '',
                        ];
                        echo form_input($facebook_box);
                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('facebook') . '</span>' : ''; ?>
                  </div>
               </div>
               <div class="col-md-6 mb-6">
                  <label class="col-form-label fw-bold fs-6"><?= lang("Common.twitter") ?></label>
                  <div class="fv-row">
                     <?php
                        $twitter_box = [
                            'name' => 'twitter',
                            'class' => 'form-control form-control-lg form-control-solid',
                            'value' => $twitter,
                            'placeholder' => lang("Common.twitter"),
                            'autofocus' => '',
                        ];
                        echo form_input($twitter_box);
                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('twitter') . '</span>' : ''; ?>
                  </div>
               </div>
               <div class="clearfix"></div>
               <div class="col-md-6 mb-6">
                  <label class="col-form-label fw-bold fs-6"><?= lang("Common.instagram") ?></label>
                  <div class="fv-row">
                     <?php
                        $instagram_box = [
                            'name' => 'instagram',
                            'class' => 'form-control form-control-lg form-control-solid',
                            'value' => $instagram,
                            'placeholder' => lang("Common.instagram"),
                            'autofocus' => '',
                        ];
                        echo form_input($instagram_box);
                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('instagram') . '</span>' : ''; ?>
                  </div>
               </div>
               <div class="col-md-6 mb-6">
                  <label class="col-form-label fw-bold fs-6"><?= lang("Common.youtube") ?></label>
                  <div class="fv-row">
                     <?php
                        $youtube_box = [
                            'name' => 'youtube',
                            'class' => 'form-control form-control-lg form-control-solid',
                            'value' => $youtube,
                            'placeholder' => lang("Common.youtube"),
                            'autofocus' => '',
                        ];
                        echo form_input($youtube_box);
                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('youtube') . '</span>' : ''; ?>
                  </div>
               </div>
               <hr class="mt30 mb30"/>
               <h4>Form Submit Email</h4>
               <div class="col-md-6 mb-6">
                  <label class="col-form-label fw-bold fs-6"><?= lang("Common.prayer_request_email") ?></label>
                  <div class="fv-row">
                     <?php
                        $prayer_request_email = [
                            'name' => 'prayer_request_email',
                            'class' => 'form-control form-control-lg form-control-solid',
                            'value' => $prayer_request_email,
                            'placeholder' => lang("Common.prayer_request_email"),
                            'autofocus' => '',
                        ];
                        echo form_input($prayer_request_email);
                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('prayer_request_email') . '</span>' : ''; ?>
                  </div>
               </div>
               <div class="col-md-6 mb-6">
                  <label class="col-form-label fw-bold fs-6"><?= lang("Common.contact_form") ?></label>
                  <div class="fv-row">
                     <?php
                        $contact_form = [
                            'name' => 'contact_form',
                            'class' => 'form-control form-control-lg form-control-solid',
                            'value' => $contact_form,
                            'placeholder' => lang("Common.contact_form"),
                            'autofocus' => '',
                        ];
                        echo form_input($contact_form);
                        echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('contact_form') . '</span>' : ''; ?>
                  </div>
               </div>
               <div class="clearfix"></div>
               <!-- <div class="col-md-12 mb-12">
                  <label class="col-form-label fw-bold fs-6"><?= lang("Common.copyright") ?></label>
                  <div class="fv-row">
                  	<?php
                     $copyright_box = [
                         'name' => 'copyright',
                         'class' => 'form-control form-control-lg form-control-solid',
                         'value' => $copyright,
                         'placeholder' => lang("Common.copyright"),
                         'autofocus' => '',
                     ];
                     echo form_input($copyright_box);
                     echo (isset($validation)) ? '<span class="d-block invalid-feedback">' . $validation->getError('copyright') . '</span>' : ''; ?>
                  </div>
                  </div>
                  -->
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
<script type="text/javascript">
   var obj = {'address': '<?=$address?>'};
</script>