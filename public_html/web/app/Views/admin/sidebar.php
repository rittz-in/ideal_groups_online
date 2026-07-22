<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
   data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
   data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
   data-kt-drawer-toggle="#kt_aside_mobile_toggle">
   <div class="aside-logo flex-column-auto" id="kt_aside_logo">
      <a href="<?= $base_url ?>" class=" p-2 w-50">
         <!-- <a href="<?= $base_url ?>" class="bg-white p-2 w-50"> -->
         <img alt="Logo" src="<?php echo $image_tool_path . $settings['logo_url'] . '&h=40'; ?>" class="logo" />
      </a>
      <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
         data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
         data-kt-toggle-name="aside-minimize">
         <span class="svg-icon svg-icon-1 rotate-180">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
               height="24px" viewBox="0 0 24 24" version="1.1">
               <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <polygon points="0 0 24 0 24 24 0 24" />
                  <path
                     d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                     fill="#000000" fill-rule="nonzero"
                     transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                  <path
                     d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                     fill="#000000" fill-rule="nonzero" opacity="0.5"
                     transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
               </g>
            </svg>
         </span>
      </div>
   </div>
   <div class="aside-menu flex-column-fluid">
      <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
         data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
         data-kt-scroll-offset="0">
         <div
            class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true">
            <div class="menu-item">
               <?php $is_dashboard_menu_active = ($page_name == 'home_page') ? 'active' : ''; ?>
               <a class="menu-link <?= $is_dashboard_menu_active ?>" href="<?= $base_url ?>">
                  <span class="menu-icon">
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                           version="1.1">
                           <path
                              d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                              fill="#000000" opacity="0.3" />
                           <path
                              d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                              fill="#000000" />
                        </svg>
                     </span>
                  </span>
                  <span class="menu-title">Dashboard</span>
               </a>
            </div>
            <?php if (in_array('2', $session_userdata['role_permission'])) {
               $is_user_menu_page_name = ['user', 'add_user'];
               $is_user_menu = (in_array($page_name, $is_user_menu_page_name)) ? 'show' : '';
               ?>
               <!-- <div data-kt-menu-trigger="click" class="menu-item <?= $is_user_menu ?> menu-accordion">
               <span class="menu-link">
                  <span class="menu-icon">
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                           <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                        </svg>
                     </span>
                  </span>
                  <span class="menu-title"><?= lang("Common.user") ?></span>
                  <span class="menu-arrow"></span>
               </span>
               <div class="menu-sub menu-sub-accordion menu-active-bg">
                  <div class="menu-item">
                     <?php
                     $is_user_list_menu = ($page_name == 'user') ? 'active' : '';
                     echo anchor(route_to('user_list_url'), '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">' . lang("Common.user") . '</span>', 'title="' . lang("Common.user") . '" class="menu-link ' . $is_user_list_menu . '"'); ?>
                  </div>
                  <?php if (in_array('3', $session_userdata['role_permission'])): ?>
                     <div class="menu-item">
                        <?php
                        $is_user_add_menu = ($page_name == 'add_user') ? 'active' : '';
                        echo anchor(route_to('user_add_url'), '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">' . lang("Common.add_user") . '</span>', 'title="' . lang("Common.add_user") . '" class="menu-link ' . $is_user_add_menu . '"'); ?>
                     </div>
                  <?php endif ?>
               </div>
               </div> -->
               <?php
            }


            $is_banner_menu_page_name = ['home_page_banner', 'add_home_page_banner'];
            $is_banner_menu = (in_array($page_name, $is_banner_menu_page_name)) ? 'show' : '';
            ?>
            <div data-kt-menu-trigger="click" class="menu-item <?= $is_banner_menu ?> menu-accordion">
               <span class="menu-link">
                  <span class="menu-icon">
                     <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks.svg-->
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                           height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24" />
                              <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                              <path
                                 d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                 fill="#000000" opacity="0.3" />
                           </g>
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-title"><?= lang("Common.home_banners") ?></span>
                  <span class="menu-arrow"></span>
               </span>
               <div class="menu-sub menu-sub-accordion menu-active-bg">
                  <div class="menu-item">
                     <?php
                     $is_banner_list_menu = ($page_name == 'home_page_banner') ? 'active' : '';
                     echo anchor(route_to('home_banners_list_url'), '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">' . lang("Common.home_banners") . '</span>', 'title="' . lang("Common.home_banners") . '" class="menu-link ' . $is_banner_list_menu . '"'); ?>
                  </div>
                  <?php if (in_array('7', $session_userdata['role_permission'])): ?>
                     <div class="menu-item">
                        <?php
                        $is_banner_add_menu = ($page_name == 'add_home_page_banner') ? 'active' : '';
                        echo anchor(route_to('home_banner_add_url'), '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">' . lang("Common.add_home_banner") . '</span>', 'title="' . lang("Common.add_home_banner") . '" class="menu-link ' . $is_banner_add_menu . '"'); ?>
                     </div>
                  <?php endif ?>
               </div>
            </div>
            <?php


            /*------------------ Add Category Section------------------------------*/


            $is_category_menu_page_name = ['category', 'add_category'];
            $is_category_menu = (in_array($page_name, $is_category_menu_page_name)) ? 'show' : '';
            ?>
            <div data-kt-menu-trigger="click" class="menu-item <?= $is_category_menu ?> menu-accordion">
               <span class="menu-link">
                  <span class="menu-icon">
                     <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks.svg-->
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                           height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24" />
                              <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                              <path
                                 d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                 fill="#000000" opacity="0.3" />
                           </g>
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-title"><?= lang("Common.category") ?></span>
                  <span class="menu-arrow"></span>
               </span>
               <div class="menu-sub menu-sub-accordion menu-active-bg">
                  <div class="menu-item">
                     <?php
                     $is_category_list_menu = ($page_name == 'category') ? 'active' : '';
                     echo anchor(route_to('category_list_url'), '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">' . lang("Common.category") . '</span>', 'title="' . lang("Common.category") . '" class="menu-link ' . $is_category_list_menu . '"'); ?>
                  </div>
                  <?php if (in_array('7', $session_userdata['role_permission'])): ?>
                     <div class="menu-item">
                        <?php
                        $is_category_add_menu = ($page_name == 'add_category') ? 'active' : '';
                        echo anchor(route_to('category_add_url'), '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">' . lang("Common.add_category") . '</span>', 'title="' . lang("Common.add_category") . '" class="menu-link ' . $is_category_add_menu . '"'); ?>
                     </div>
                  <?php endif ?>
               </div>
            </div>
            <?php


            /* ------------------------------------ Product Section ----------------------------------*/


            $is_product_menu_page_name = ['product', 'add_product'];
            $is_product_menu = (in_array($page_name, $is_product_menu_page_name)) ? 'show' : '';
            ?>
            <div data-kt-menu-trigger="click" class="menu-item <?= $is_product_menu ?> menu-accordion">
               <span class="menu-link">
                  <span class="menu-icon">
                     <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks.svg-->
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                           height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24" />
                              <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                              <path
                                 d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                 fill="#000000" opacity="0.3" />
                           </g>
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-title"><?= lang("Common.product") ?></span>
                  <span class="menu-arrow"></span>
               </span>
               <div class="menu-sub menu-sub-accordion menu-active-bg">
                  <div class="menu-item">
                     <?php
                     $is_product_list_menu = ($page_name == 'product') ? 'active' : '';
                     echo anchor(route_to('product_list_url'), '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">' . lang("Common.product") . '</span>', 'title="' . lang("Common.product") . '" class="menu-link ' . $is_product_list_menu . '"'); ?>
                  </div>
                  <?php if (in_array('7', $session_userdata['role_permission'])): ?>
                     <div class="menu-item">
                        <?php
                        $is_product_add_menu = ($page_name == 'add_product') ? 'active' : '';
                        echo anchor(route_to('product_add_url'), '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">' . lang("Common.add_product") . '</span>', 'title="' . lang("Common.add_product") . '" class="menu-link ' . $is_product_add_menu . '"'); ?>
                     </div>
                  <?php endif ?>
               </div>
            </div>
            <?php


            /*---------------------- Client Section -------------------------------*/


            $is_client_menu_page_name = ['client', 'add_client'];
            $is_client_menu = (in_array($page_name, $is_client_menu_page_name)) ? 'show' : '';
            ?>
            <div data-kt-menu-trigger="click" class="menu-item <?= $is_client_menu ?> menu-accordion">
               <span class="menu-link">
                  <span class="menu-icon">
                     <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks.svg-->
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                           height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24" />
                              <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                              <path
                                 d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                 fill="#000000" opacity="0.3" />
                           </g>
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-title"><?= lang("Common.client") ?></span>
                  <span class="menu-arrow"></span>
               </span>
               <div class="menu-sub menu-sub-accordion menu-active-bg">
                  <div class="menu-item">
                     <?php
                     $is_client_list_menu = ($page_name == 'client') ? 'active' : '';
                     echo anchor(route_to('client_list_url'), '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">' . lang("Common.client") . '</span>', 'title="' . lang("Common.client") . '" class="menu-link ' . $is_client_list_menu . '"'); ?>
                  </div>
                  <?php if (in_array('7', $session_userdata['role_permission'])): ?>
                     <div class="menu-item">
                        <?php
                        $is_client_add_menu = ($page_name == 'add_client') ? 'active' : '';
                        echo anchor(route_to('client_add_url'), '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title">' . lang("Common.add_client") . '</span>', 'title="' . lang("Common.add_client") . '" class="menu-link ' . $is_client_add_menu . '"'); ?>
                     </div>
                  <?php endif ?>
               </div>
            </div>
            <?php

            ?>
            <div class="menu-item">
               <?php $is_contact_menu_active = ($page_name == 'contact_lists' || $page_name == 'contact_page') ? 'active' : ''; ?>
               <a class="menu-link <?= $is_contact_menu_active ?>" href="<?= $base_url; ?>admin/contacts">
                  <span class="menu-icon">
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                           height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24" />
                              <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                              <path
                                 d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                 fill="#000000" opacity="0.3" />
                           </g>
                        </svg>
                     </span>
                  </span>
                  <span class="menu-title">Contact Us</span>
               </a>
            </div>



            <!-- <div class="menu-item">
               <?php // $is_contact_menu_active = ($page_name == 'contact_us') ? 'active' : ''; ?>
               <a class="menu-link <? // =$is_contact_menu_active ?>" href="<? //=$base_url ?>admin/contact">
                  <span class="menu-icon">
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24" />
                              <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                              <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                           </g>
                        </svg>
                     </span>
                  </span>
                  <span class="menu-title">Contact Us</span>
               </a>
            </div> -->



            <div class="menu-item">
               <?php $is_settings_menu_active = ($page_name == 'settings') ? 'active' : ''; ?>
               <a class="menu-link <?= $is_settings_menu_active ?>" href="<?= $base_url ?>admin/settings">
                  <span class="menu-icon">
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                           version="1.1">
                           <path
                              d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                              fill="#000000" opacity="0.3" />
                           <path
                              d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                              fill="#000000" />
                        </svg>
                     </span>
                  </span>
                  <span class="menu-title">Settings</span>
               </a>
            </div>
            <?php
            $is_client = $UserData['is_client'];

            if ($is_client == 'no') {
               ?>
               <div class="menu-item">
                  <?php $is_client_profile_menu_active = ($page_name == 'client_profile') ? 'active' : ''; ?>
                  <a class="menu-link <?= $is_client_profile_menu_active ?>" href="<?= $base_url ?>admin/client_profile">
                     <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                              version="1.1">
                              <path
                                 d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                 fill="#000000" opacity="0.3" />
                              <path
                                 d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                 fill="#000000" />
                           </svg>
                        </span>
                     </span>
                     <span class="menu-title">Admin Profile</span>
                  </a>
               </div>
               <?php
            }
            ?>
            <div class="menu-item">
               <?php $is_reset_password_menu_active = ($page_name == 'reset_password') ? 'active' : ''; ?>
               <a class="menu-link <?= $is_reset_password_menu_active ?>" href="<?= $base_url ?>admin/reset_password">
                  <span class="menu-icon">
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                           version="1.1">
                           <path
                              d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                              fill="#000000" opacity="0.3" />
                           <path
                              d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                              fill="#000000" />
                        </svg>
                     </span>
                  </span>
                  <span class="menu-title">Reset Password</span>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>