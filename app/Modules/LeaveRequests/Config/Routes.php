<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group("leave-requests", ["namespace" => "App\Modules\LeaveRequests\Controllers", "filter" => "session"], function ($routes) {
    $routes->post("create", "LeaveRequestsController::create");
    $routes->get("view/(:num)", "LeaveRequestsController::view/$1");
    $routes->post("edit/(:num)", "LeaveRequestsController::edit/$1");
    $routes->post("delete/(:num)", "LeaveRequestsController::delete/$1");
    $routes->post("restore/(:num)", "InternalRequestController::restore/$1");
    $routes->post("handle/(:num)", "LeaveRequestsController::handle/$1");
});
