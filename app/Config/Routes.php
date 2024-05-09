<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::loginPage');
$routes->post("/", "UserController::login");
$routes->get("/deconnexion", "UserController::logout");

$routes->group('', ['filter' => 'auth'], function ($routes) {
  $routes->get('tableau-de-bord', 'UserController::dashboard');
  $routes->group('utilisateurs', function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->post('/', 'UserController::create');
    $routes->get('supprimer/(:num)', 'UserController::delete/$1');
  });
});
