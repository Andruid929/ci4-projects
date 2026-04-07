<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Dashboard', ['filter' => ['guest', 'standardUser']]);
$routes->get('admin/dashboard', 'Dashboard::admin', ['filter' => ['guest', 'admin']]);
$routes->get('logout', 'Logout');
$routes->get('login', 'Login', ['filter' => 'userFilter']);
$routes->get('signup', 'SignUp', ['filter' => 'userFilter']);
$routes->post('signup/submit', '\App\Core\Auth\Auth::authenticateSignUp');
$routes->post('login/submit', '\App\Core\Auth\Auth::authenticateSignIn');