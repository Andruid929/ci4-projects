<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

service('auth')->routes($routes, ['except' => ['login', 'register']]);

$routes->get("/", "Home");

$routes->get("login", "LoginController");
$routes->post("login", "LoginController::loginAction");

$routes->get("register", "\App\Controllers\RegisterController");
$routes->post("register", "\App\Controllers\RegisterController::registerAction");

//Only while logged in
$routes->group("dashboard", ["filter" => ["session", "roles"]], function ($routes) {
    $routes->get("/", "\App\Core\Controllers\DashboardController");
    $routes->get("manager", "\App\Core\Controllers\DashboardController::manager");
    $routes->get("admin", "\App\Core\Controllers\DashboardController::admin");
});

$routes->post("logout", "LoginController::logoutAction", ["filter" => "session"]);
