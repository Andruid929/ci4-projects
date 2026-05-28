<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get("/", "Home");

$routes->get("login", "LoginController");
$routes->post("login", "LoginController::loginAction");

$routes->get("register", "\App\Controllers\RegisterController");
$routes->post("register", "\App\Controllers\RegisterController::registerAction");

//Only while logged in
$routes->group("dashboard", ["filter" => ["session", "roles"]], function ($routes) {
    $routes->get("/", "\App\Core\Controllers\DashboardController::showDashboard");
    $routes->get("(:segment)", "\App\Core\Controllers\DashboardController::showDashboard/$1");
});

$routes->post("logout", "LoginController::logoutAction", ["filter" => "session"]);

$routes->group("internal-requests", ["namespace" => "App\Modules\InternalRequest\Controllers", "filter" => "session"], function ($routes) {
    $routes->post("create", "InternalRequestController::create");
    $routes->get("view/(:num)", "InternalRequestController::view/$1");
    $routes->post("edit/(:num)", "InternalRequestController::edit/$1");
    $routes->post("delete/(:num)", "InternalRequestController::delete/$1");
    $routes->post("approve/(:num)", "InternalRequestController::approve/$1");
    $routes->post("deny/(:num)", "InternalRequestController::deny/$1");
});

$routes->group("leave-requests", ["namespace" => "App\Modules\LeaveRequests\Controllers", "filter" => "session"], function ($routes) {
    $routes->post("create", "LeaveRequestsController::create");
    $routes->get("view/(:num)", "LeaveRequestsController::view/$1");
    $routes->post("edit/(:num)", "LeaveRequestsController::edit/$1");
    $routes->post("delete/(:num)", "LeaveRequestsController::delete/$1");
    $routes->post("approve/(:num)", "LeaveRequestsController::approve/$1");
    $routes->post("deny/(:num)", "LeaveRequestsController::deny/$1");
});
