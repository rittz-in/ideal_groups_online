<?php

/*
| --------------------------------------------------------------------
| App Namespace
| --------------------------------------------------------------------
|
| This defines the default Namespace that is used throughout
| CodeIgniter to refer to the Application directory. Change
| this constant to change the namespace that all application
| classes should use.
|
| NOTE: changing this will require manually modifying the
| existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
| --------------------------------------------------------------------------
| Composer Path
| --------------------------------------------------------------------------
|
| The path that Composer's autoload file is expected to live. By default,
| the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

defined('FC_PATH') || define('FC_PATH', substr(FCPATH, 0, -1)."/"); // no errors

/*
|--------------------------------------------------------------------------
| Timing Constants
|--------------------------------------------------------------------------
|
| Provide simple ways to work with the myriad of PHP functions that
| require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR') || define('HOUR', 3600);
defined('DAY') || define('DAY', 86400);
defined('WEEK') || define('WEEK', 604800);
defined('MONTH') || define('MONTH', 2592000);
defined('YEAR') || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
| --------------------------------------------------------------------------
| Exit Status Codes
| --------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
 */
defined('EXIT_SUCCESS') || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('AES_256_CBC') || define('AES_256_CBC', 'aes-256-cbc');

defined('admin_links') || define('admin_links', 'admin_links');
defined('roles') || define('roles', 'roles');
defined('admin_user') || define('admin_user', 'admin_user');
defined('user') || define('user', 'user');
defined('settings') || define('settings', 'settings');
defined('banners') || define('banners', 'banners');
defined('events') || define('events', 'events');
defined('event_images') || define('event_images', 'event_images');
defined('ministries') || define('ministries', 'ministries');
defined('member_services') || define('member_services', 'member_services');
defined('gallery_categories') || define('gallery_categories', 'gallery_categories');
defined('gallery_images') || define('gallery_images', 'gallery_images');
defined('prayer_request') || define('prayer_request', 'prayer_request');
defined('contact_us') || define('contact_us', 'contact_us');
defined('member_alter_call_response') || define('member_alter_call_response', 'member_alter_call_response');
defined('baby_dedication') || define('baby_dedication', 'baby_dedication');
defined('baptism_ceremony') || define('baptism_ceremony', 'baptism_ceremony');
defined('funeral_ceremony') || define('funeral_ceremony', 'funeral_ceremony');
defined('hospital_visitation') || define('hospital_visitation', 'hospital_visitation');
defined('join_our_email_list') || define('join_our_email_list', 'join_our_email_list');
defined('transportation_request') || define('transportation_request', 'transportation_request');
defined('volunteers') || define('volunteers', 'volunteers');
defined('wedding_ceremony') || define('wedding_ceremony', 'wedding_ceremony');
defined('get_connected') || define('get_connected', 'get_connected');
defined('all_pages') || define('all_pages', 'all_pages');
defined('home_page_settings') || define('home_page_settings', 'home_page_settings');
defined('vision_page_settings') || define('vision_page_settings', 'vision_page_settings');
defined('pastors_engagement') || define('pastors_engagement', 'pastors_engagement');
