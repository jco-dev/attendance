<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Inicio');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

/** Root  */
$routes->get('/', 'Tablero::index', ['name' => 'tablero']);

/** Auth */
$routes->get('login', 'Login::index', ['name' => 'login']);
$routes->post('login', 'Login::authenticate', ['name' => 'login']);
$routes->post('salir', 'Login::salir', ['name' => 'salir']);

/** Marcado */
$routes->get('marcado', 'Asistencia::index', ['name' => 'marcado', 'filter' => 'auth:superadmin,admin']);

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
