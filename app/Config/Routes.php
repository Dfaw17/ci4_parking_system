<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');
$routes->get('/login', 'HomeController::login_page');
$routes->post('/login/confirm', 'HomeController::login');
$routes->get('/logout', 'HomeController::logout');

$routes->get('/users', 'UserController::index');
$routes->get('/users/create', 'UserController::create');
$routes->post('/users/save', 'UserController::save');
$routes->get('/users/edit/(:any)', 'UserController::edit/$1');
$routes->post('/users/update/(:any)', 'UserController::update/$1');
$routes->get('/users/delete/(:any)', 'UserController::delete/$1');

$routes->get('/payment', 'PaymentController::index');
$routes->get('/payment/create', 'PaymentController::create');
$routes->post('/payment/save', 'PaymentController::save');
$routes->get('/payment/edit/(:any)', 'PaymentController::edit/$1');
$routes->post('/payment/update/(:any)', 'PaymentController::update/$1');
$routes->get('/payment/delete/(:any)', 'PaymentController::delete/$1');

$routes->get('/vehicle', 'VehicleController::index');
$routes->get('/vehicle/create', 'VehicleController::create');
$routes->post('/vehicle/save', 'VehicleController::save');
$routes->get('/vehicle/edit/(:any)', 'VehicleController::edit/$1');
$routes->post('/vehicle/update/(:any)', 'VehicleController::update/$1');
$routes->get('/vehicle/delete/(:any)', 'VehicleController::delete/$1');
$routes->get('/vehicle/reactivate/(:any)', 'VehicleController::reactivate/$1');

$routes->get('/price', 'PriceController::index');

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
