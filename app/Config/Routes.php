<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::loginPage');
$routes->post("/", "UserController::login");