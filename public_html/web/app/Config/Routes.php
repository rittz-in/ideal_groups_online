<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override('App\Controllers\Four_zero_four::Index');
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/admin/', 'Home::index');
$routes->add('/admin/login', 'Home::login', ['as' => 'login_url']);
$routes->add('/admin/logout', 'Home::logout', ['as' => 'logout_url']);
$routes->add('/admin/reset_password', 'Home::reset_password', ['as' => 'reset_password_url']);
$routes->add('/admin/client_profile', 'Home::client_profile', ['as' => 'client_profile_url']);


$routes->add('/admin/home_banners', 'HomeBanners::index', ['as' => 'home_banners_list_url']);
$routes->add('/admin/home_banners_list', 'HomeBanners::get_all', ['as' => 'home_banner_list_all_url']);
$routes->add('/admin/home_banners/edit/(:any)', 'HomeBanners::add/$1', ['as' => 'home_banner_edit_url']);
$routes->add('/admin/home_banners/delete/(:any)', 'HomeBanners::delete/$1', ['as' => 'home_banner_delete_url']);
$routes->add('/admin/home_banners/add', 'HomeBanners::add', ['filter' => 'auth:role|6,role|7', 'as' => 'home_banner_add_url']);

/*---------------------------  Category Section -------------------------*/
$routes->add('/admin/category', 'Category::index', ['as' => 'category_list_url']);
$routes->add('/admin/category_list', 'Category::get_all', ['as' => 'category_list_all_url']);
$routes->add('/admin/category/add', 'Category::add', ['filter' => 'auth:role|6,role|7', 'as' => 'category_add_url']);
$routes->add('/admin/category/edit/(:any)', 'Category::add/$1', ['as' => 'category_edit_url']);
$routes->add('/admin/category/delete/(:any)', 'Category::delete/$1', ['as' => 'category_delete_url']);


/*---------------------------  Product Section -------------------------*/
$routes->add('/admin/product', 'Product::index', ['as' => 'product_list_url']);
$routes->add('/admin/product_list', 'Product::get_all', ['as' => 'product_list_all_url']);
$routes->add('/admin/product/add', 'Product::add', ['filter' => 'auth:role|6,role|7', 'as' => 'product_add_url']);
$routes->add('/admin/product/edit/(:any)', 'Product::add/$1', ['as' => 'product_edit_url']);
$routes->add('/admin/product/delete/(:any)', 'Product::delete/$1', ['as' => 'product_delete_url']);


/*---------------------------  Client Section -------------------------*/
$routes->add('/admin/client', 'Client::index', ['as' => 'client_list_url']);
$routes->add('/admin/client_list', 'Client::get_all', ['as' => 'client_list_all_url']);
$routes->add('/admin/client/add', 'Client::add', ['filter' => 'auth:role|6,role|7', 'as' => 'client_add_url']);
$routes->add('/admin/client/edit/(:any)', 'Client::add/$1', ['as' => 'client_edit_url']);
$routes->add('/admin/client/delete/(:any)', 'Client::delete/$1', ['as' => 'client_delete_url']);

$routes->add('/admin/contacts', 'Contact::index', ['as' => 'contacts_url']);
$routes->add('/admin/contacts_list', 'Contact::get_all', ['as' => 'contacts_list_all_url']);




$routes->add('/admin/settings', 'Settings::index', ['as' => 'settings_url']);
$routes->add('/admin/settings/add', 'Settings::add', ['as' => 'settings_add_url']);

/* ----------------Front Path Start --------------*/
$routes->get('/', 'Front::index', ['as' => "home_page_url"]);
$routes->get('/about', 'Front::about', ['as' => "about_page_url"]);
$routes->get('/products', 'Front::products', ['as' => "products_page_url"]);
$routes->get('/clients', 'Front::clients', ['as' => "clients_page_url"]);
$routes->add('/contact', 'Front::contact', ['as' => "contact_page_url"]);
$routes->add('/contact_details', 'Front::contact_details', ['as' => "contact_details_page_url"]);
$routes->get('/category/(:any)', 'Front::product_list/$1', ['as' => "product_list_page_url"]);

$routes->add('/category_form/(:any)', 'Front::category_form/$1', ['as' => "category_form_add"]);

/*----------Email----------*/

$routes->post('email/send-email', 'Email::send_email', ['as' => "send_email_url"]);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
