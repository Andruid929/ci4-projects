<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group("reports", function ($routes) {
    $routes->get("daily", '\App\Modules\Reports\Controllers\Reports::daily');
    $routes->get("summary", '\App\Modules\Reports\Controllers\Reports::summary');
    $routes->get("user/(:segment)", '\App\Modules\Reports\Controllers\Reports::user/$1');
});