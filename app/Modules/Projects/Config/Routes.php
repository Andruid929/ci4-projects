<?php

namespace App\Modules\Projects\Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get("project/(:num)", "\App\Modules\Projects\Controllers\ProjectController::openProject/$1");
$routes->get("projects", "\App\Modules\Projects\Controllers\ProjectController");
$routes->post("projects/create", "\App\Modules\Projects\Controllers\ProjectController::createProject");