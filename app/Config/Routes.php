<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home');
$routes->get('sign', '\App\Core\Auth\Controllers\Auth'); //Display the sign in page itself
$routes->get('signin', '\App\Core\Auth\Controllers\Auth::invalid'); //Invalid route should return 404
$routes->get('dashboard', '\App\Core\Common\Controllers\Dashboard');
$routes->post('sign_in', '\App\Core\Auth\Controllers\Auth::attempt'); //This one processes the sign in attempt

//require_once APPPATH . 'Modules/Tickets/Config/Routes.php';
//require_once APPPATH . 'Modules/Reports/Config/Routes.php';