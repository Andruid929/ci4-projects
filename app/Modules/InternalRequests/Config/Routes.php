<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group("internal-requests", ["namespace" => "App\Modules\InternalRequests\Controllers", "filter" => "session"], function ($routes) {
    $routes->post("create", "InternalRequestController::create");
    $routes->get("view/(:num)", "InternalRequestController::view/$1");
    $routes->post("edit/(:num)", "InternalRequestController::edit/$1");
    $routes->post("delete/(:num)", "InternalRequestController::delete/$1");
    $routes->post("restore/(:num)", "InternalRequestController::restore/$1");
    $routes->post("handle/(:num)", "InternalRequestController::handle/$1");
});
