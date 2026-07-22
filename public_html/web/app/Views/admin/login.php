<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title><?php echo $page_title.' | '.$website_title ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="shortcut icon" href="<?php echo $admin_assets_path; ?>media/logos/favicon.ico" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
      <link href="<?php echo $admin_assets_path; ?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo $admin_assets_path; ?>css/style.bundle.css" rel="stylesheet" type="text/css" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara&display=swap" rel="stylesheet">
   </head>
   <body id="kt_body" class="bg-dark">
      <div class="d-flex flex-column flex-root">
         <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-size1: 100% 50%; background-image: url(<?php echo $admin_assets_path; ?>media/misc/outdoor.png)">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
               <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
                  <div class="d-flex flex-center flex-column">
                     <a href="#" class="mb-12">
                     <img alt="Logo" src="<?php echo $site_logo;?>" class="h-45px" />
                     </a>
                  </div>
                  <?php
                     $attributes = 'name="login" id="kt_sign_in_form" class="login" enctype="multipart/form-data" novalidate="novalidate"';
                     $hidden     = array();
                     echo form_open(route_to('login_url'), $attributes, $hidden);
                     ?>
                  <div class="text-center mb-10">
                     <h1 class="text-dark mb-3"><?=lang('Common.sign_in')?></h1>
                  </div>
                  <?=get_flash_data($session_flash);?>
                  <div class="fv-row mb-10">
                     <label class="form-label fs-6 fw-bolder text-dark"><?=lang('Common.email').' '.astrik(); ?></label>
                     <?php
                        $email_box = [
                            'name'      => 'email',
                            'class'     => 'form-control form-control-lg form-control-solid',
                            'placeholder' => lang('Common.email'),
                            'autocomplete' => 'off',
                            'autofocus' => '',
                        ];
                        echo form_input($email_box);?>
                  </div>
                  <div class="fv-row mb-10">
                     <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-dark fs-6 mb-0"><?=lang('Common.password').' '.astrik(); ?></label>
                      <!-- <a href="reset_password" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>   --!>
                     </div>
                     <?php
                        $email_box = [
                            'name'      => 'password',
                            'class'     => 'form-control form-control-lg form-control-solid',
                            'placeholder' => lang('Common.password'),
                            'autocomplete' => 'off',
                            'type' => 'password',
                        ];
                        echo form_input($email_box);?>
                  </div>
                  <div class="text-center">
                     <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                     <span class="indicator-label">Continue</span>
                     <span class="indicator-progress">Please wait...
                     <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                     </button>
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
      </div>
      <script src="<?php echo $admin_assets_path; ?>plugins/global/plugins.bundle.js"></script>
      <script src="<?php echo $admin_assets_path; ?>js/scripts.bundle.js"></script>
      <script src="<?php echo $admin_assets_path; ?>js/custom/authentication/sign-in/general.js"></script>
   </body>
</html>