<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::loginPage');
$routes->post("/", "UserController::login");
$routes->get("/deconnexion", "UserController::logout");

$routes->group('', ['filter' => 'auth'], function ($routes) {
  $routes->group('', ['filter' => 'isAdmin'], function ($routes) {
    $routes->get('tableau-de-bord', 'UserController::dashboard');
    $routes->group('utilisateurs', function ($routes) {
      $routes->get('/', 'UserController::index');
      $routes->post('/', 'UserController::create');
      $routes->get('supprimer/(:num)', 'UserController::delete/$1');
    });

    $routes->group('inventaire', function ($routes) {
      $routes->get('/', 'ItemController::index');
      $routes->post('/', 'ItemController::create');
      $routes->post('modifier', 'ItemController::update');
      $routes->get('supprimer/(:num)', 'ItemController::delete/$1');
    });

    $routes->get("rapports", "ReportController::index");
  });

  $routes->group('factures', function ($routes) {
    $routes->get('/', 'InvoiceController::index');
    $routes->get('creer', 'InvoiceController::createPage');
    $routes->get('creer/token', 'InvoiceController::create_token');
    $routes->get('creer/getItems', 'InvoiceController::get_items');
    $routes->post('creer/createInvoice', 'InvoiceController::create');
    $routes->get('supprimer/(:num)', 'InvoiceController::delete/$1');
    $routes->get('(:num)', 'InvoiceController::print/$1');
  });
});
