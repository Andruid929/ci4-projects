<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group("tickets", function ($routes) {
    $routes->get("/", '\App\Modules\Tickets\Controllers\Tickets');
    $routes->get("new", '\App\Modules\Tickets\Controllers\Tickets::new');
    $routes->post("save", '\App\Modules\Tickets\Controllers\Tickets::save');
    $routes->get("view/(:num)", '\App\Modules\Tickets\Controllers\Tickets::view/$1');
    $routes->get("edit/(:num)", '\App\Modules\Tickets\Controllers\Tickets::edit/$1');
});