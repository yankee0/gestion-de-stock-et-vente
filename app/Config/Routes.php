<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::loginPage');
$routes->post("/", "UserController::login");

$routes->group('', ['filter' => 'auth'], function ($routes) {
  $routes->get('tableau-de-bord', 'UserController::dashboard');
});
