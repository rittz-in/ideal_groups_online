<!DOCTYPE html>
<html>
   <?php echo view('admin/header.php'); ?>
   <body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
      <div class="d-flex flex-column flex-root">
         <div class="page d-flex flex-row flex-column-fluid">
            <?php echo view('admin/sidebar.php'); ?>
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
               <?php echo view('admin/menu.php'); ?>
               <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                  <div class="toolbar" id="kt_toolbar">
                     <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                           <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3"><?= $header;?></h1>
                           <!-- <span class="h-20px border-gray-200 border-start mx-4"></span>
                              <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                              	<li class="breadcrumb-item text-muted">
                              		<a href="index.html" class="text-muted text-hover-primary">Home</a>
                              	</li>
                              	<li class="breadcrumb-item">
                              		<span class="bullet bg-gray-200 w-5px h-2px"></span>
                              	</li>
                              	<li class="breadcrumb-item text-muted">User Management</li>
                              	<li class="breadcrumb-item">
                              		<span class="bullet bg-gray-200 w-5px h-2px"></span>
                              	</li>
                              	<li class="breadcrumb-item text-muted">Users</li>
                              	<li class="breadcrumb-item">
                              		<span class="bullet bg-gray-200 w-5px h-2px"></span>
                              	</li>
                              	<li class="breadcrumb-item text-dark">Users List</li>
                              </ul> -->
                        </div>
                     </div>
                  </div>
                  <?=(get_flash_data($session_flash) != '')?'<div class="container" id="fls_container">'.get_flash_data($session_flash).'</div>':'';?>
                  <?php echo view($child_view); ?>
               </div>
               <?php echo view('admin/footer.php'); ?>
            </div>
         </div>
      </div>
      <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
         <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
               <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <polygon points="0 0 24 0 24 24 0 24" />
                  <rect fill="#000000" opacity="0.5" x="11" y="10" width="2" height="10" rx="1" />
                  <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
               </g>
            </svg>
         </span>
      </div>
      <?php
         $currentURL = current_url();
         $params   = $_SERVER['QUERY_STRING'];
         $fullURL = $currentURL . '?' . $params; 
         $router = \Config\Services::router();
         $_method = $router->methodName();
         $_controller = $router->controllerName();
         ?>
      <script type="text/javascript">
         var main_base_url = '<?php echo $base_url; ?>';
         var base_url = '<?php echo $base_url.''.$_method; ?>';
         var current_url = '<?php echo $currentURL; ?>';
         var page_name = '<?php echo $page_name; ?>';
         var assets_path = '<?php echo $assets_path ?>';
         var total_currency = <?php echo json_encode($total_currency); ?>
      </script>
      <?php echo view('admin/script.php'); ?>
      <script type="text/javascript">
         /*(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
         function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
         e=o.createElement(i);r=o.getElementsByTagName(i)[0];
         e.src='https://www.google-analytics.com/analytics.js';
         r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
         ga('create','UA-XXXXX-X');ga('send','pageview');*/
         $(document).ready(function(){
         	<?php //echo get_flash_data($session_flash);?>
         })
      </script>
   </body>
</html>
<?PHP die; ?>