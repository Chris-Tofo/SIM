<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'SimController::home');             // Halaman Depan / Landing Page
$routes->get('create', 'SimController::create');     // Formulir Pendaftaran Multi-step
$routes->post('store', 'SimController::store');      // Proses Simpan ke DB
$routes->get('/sim/bukti/(:segment)', 'SimController::bukti/$1');
$routes->get('/sim/cari', 'SimController::cariForm');
$routes->post('/sim/cari/proses', 'SimController::cariProses');