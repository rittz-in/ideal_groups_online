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
   </head>
   <body id="kt_body" class="bg-white">
      <div class="d-flex flex-column flex-root">
         <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(<?php echo $admin_assets_path; ?>media/illustrations/progress-hd.png)">
            <div class="d-flex flex-column flex-column-fluid text-center p-10 py-lg-20">
               <a href="index.html" class="mb-10 pt-lg-20">
               <img alt="Logo" src="<?php echo $admin_assets_path; ?>media/logos/logo.png" class="h-50px mb-5" />
               </a>
               <div class="pt-lg-10">
                  <h1 class="fw-bolder fs-4x text-gray-700 mb-10">Page Not Found</h1>
                  <div class="fw-bold fs-3 text-gray-400 mb-15">The page you looked not found!
                     <br />Plan your blog post by choosing a topic
                  </div>
                  <div class="text-center">
                     <a href="<?=$base_url?>" class="btn btn-lg btn-primary fw-bolder">Go to homepage</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="<?php echo $admin_assets_path; ?>plugins/global/plugins.bundle.js"></script>
      <script src="<?php echo $admin_assets_path; ?>js/scripts.bundle.js"></script>
   </body>
</html>