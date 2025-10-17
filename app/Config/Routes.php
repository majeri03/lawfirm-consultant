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
$routes->get('/dashboard/profile', 'AuthController::profile', ['filter' => 'auth']);
$routes->get('/dashboard/contact', 'AuthController::contact', ['filter' => 'auth']);
$routes->get('/dashboard/report', 'AuthController::report', ['filter' => 'auth']);
$routes->post('/chatbot/ask', 'ChatbotController::askAI', ['filter' => 'auth']);


$routes->get('/pelajari-layanan', 'ReportController::index');
$routes->post('/pelajari-layanan/save', 'ReportController::save');

// Rute untuk Admin
$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'AdminController::dashboard');
    $routes->get('reports', 'AdminController::getReports');
    $routes->get('reports', 'AdminController::getReports'); // Untuk mengambil data tabel
    $routes->get('report/(:num)', 'AdminController::viewReport/$1'); // Untuk melihat detail
    $routes->post('report/update-status', 'AdminController::updateStatus');
    $routes->delete('report/(:num)', 'AdminController::deleteReport/$1');
});
