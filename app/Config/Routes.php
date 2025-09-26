<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::index');
$routes->get('/register', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->post('/register', 'AuthController::register');
$routes->get('/logout', 'AuthController::logout');

// Rute ini akan dilindungi oleh filter 'auth'
$routes->get('/dashboard', 'AuthController::dashboard', ['filter' => 'auth']);

