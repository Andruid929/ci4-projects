<?php

namespace App\Modules\Tasks\Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get("task/(:num)", "\App\Modules\Tasks\Controllers\TaskController::openTask/$1");
$routes->get("tasks", "\App\Modules\Tasks\Controllers\TaskController");
$routes->post("tasks/create", "\App\Modules\Tasks\Controllers\TaskController::createTask");