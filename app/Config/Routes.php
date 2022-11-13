<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', function () {
    return redirect()->to('/admin');
});

//Auth
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::login', ['as' => 'auth']);
$routes->get('/logout', 'Login::logout', ['as' => 'logout']);

//Dashboard
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Dashboard::index', ['as' => 'dashboard']);
    $routes->group('management', function ($routes) {
        //Admin User
        $routes->get('admin_user', 'Management::admin_user', ['as' => 'admin_user']);
        $routes->post('save_admin_user', 'Management::save_admin_user', ['as' => 'save_admin_user']);
        $routes->post('edit_admin_user', 'Management::edit_admin_user', ['as' => 'edit_admin_user']);
        $routes->get('delete_admin_user/(:segment)', 'Management::delete_admin_user/$1', ['as' => 'delete_admin_user']);

        //Guest User
        $routes->get('guest_user', 'Management::guest_user', ['as' => 'guest_user']);
        $routes->post('save_guest_user', 'Management::save_guest_user', ['as' => 'save_guest_user']);
        $routes->post('edit_guest_user', 'Management::edit_guest_user', ['as' => 'edit_guest_user']);
        $routes->get('delete_guest_user/(:segment)', 'Management::delete_guest_user/$1', ['as' => 'delete_guest_user']);
        $routes->get('get_entries', 'Management::get_entries', ['as' => 'get_entries']);
    });

    //Log
    $routes->group('log', function ($routes) {
        $routes->get('accepted_log', 'Loging::accepted_log', ['as' => 'accepted']);
        $routes->get('rejected_log', 'Loging::rejected_log', ['as' => 'rejected']);
    });

    //Settings
    $routes->group('settings', function ($routes) {
        //Controller
        $routes->get('controller', 'Mcu::controller', ['as' => 'controller']);
        $routes->post('save_controller', 'Mcu::save_controller', ['as' => 'save_controller']);
        $routes->post('edit_controller', 'Mcu::edit_controller', ['as' => 'edit_controller']);
        $routes->get('delete_controller/(:segment)', 'Mcu::delete_controller/$1', ['as' => 'delete_controller']);

        //User Block
        $routes->get('user_block', 'Mcu::user_block', ['as' => 'user_block']);
        $routes->get('blocking_user/(:segment)/(:segment)', 'Mcu::blocking_user/$1/$2', ['as' => 'block_user']);
        $routes->post('save_access_user', 'Mcu::save_access_user', ['as' => 'save_access_user']);
    });
});

//API
$routes->group('api', function ($routes) {
    $routes->post('doorAPI', 'Api::index', ['as' => 'doorAPI']);
    $routes->post('settings', 'Api::settings', ['as' => 'settings']);
    $routes->post('delete_entries', 'Api::delete_entries', ['as' => 'delete_entries']);
});

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
