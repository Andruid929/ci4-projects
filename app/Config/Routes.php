<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
service("auth")->routes($routes);

//Accessible without login
$routes->get("/", "Home::index");

$routes->post("login", "LoginController::loginAction");
$routes->post("register", "RegisterController::registerAction");
$routes->get("login", "LoginController::showLoginForm");
$routes->get("register", "RegisterController::showRegisterForm");

//Only while logged in
$routes->get("dashboard", "\App\Modules\Employees\Controllers\DashboardController", ["filter" => "session"]);

$routes->post("logout", "LoginController::logoutAction", ["filter" => "session"]);

$routes->group("employee", ["filter" => "session"], function ($routes) {
    $routes->get("(:num)", "\App\Modules\Employees\Controllers\EmployeeController::view/$1");
    $routes->post("update/(:num)", "\App\Modules\Employees\Controllers\EmployeeController::update/$1");
    $routes->post("delete/(:num)", "\App\Modules\Employees\Controllers\EmployeeController::delete/$1");
    $routes->post("create", "\App\Modules\Employees\Controllers\EmployeeController::create");
    $routes->post("restore/(:num)", "\App\Modules\Employees\Controllers\EmployeeController::restore/$1");
});
