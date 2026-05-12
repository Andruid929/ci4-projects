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
