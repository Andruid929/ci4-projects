<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group("employee", ["filter" => "session"], function ($routes) {
    $routes->get("(:num)", "\App\Modules\Employees\Controllers\EmployeeController::view/$1");
    $routes->get("deleted/(:num)", "\App\Modules\Employees\Controllers\EmployeeController::viewDeleted/$1");

    $routes->post("update/(:num)", "\App\Modules\Employees\Controllers\EmployeeController::update/$1");
    $routes->post("delete/(:num)", "\App\Modules\Employees\Controllers\EmployeeController::delete/$1");
    $routes->post("create", "\App\Modules\Employees\Controllers\EmployeeController::create");
    $routes->post("restore/(:num)", "\App\Modules\Employees\Controllers\EmployeeController::restore/$1");
});