<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Inicio');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

/** Auth */
$routes->get('login', 'Login::index', ['name' => 'login']);
$routes->post('login', 'Login::authenticate', ['name' => 'login']);
$routes->post('salir', 'Login::salir', ['name' => 'salir']);

/** Root  */
$routes->get('/', 'Tablero::index', ['name' => 'tablero', 'filter' => 'auth:superadmin,admin']);

/** Marcado */
$routes->group("", ['filter' => 'auth:superadmin,admin'], function ($routes) {
    $routes->get('marcado', 'Asistencia::index', ['name' => 'marcado']);
    $routes->post('marcado', 'Asistencia::marcado', ['name' => 'marcado']);
    $routes->post('marcar-salida-confirmacion', 'Asistencia::marcarSalidaConfirmacion', ['name' => 'marcar-salida-confirmacion']);
});

/** Persona */
$routes->get('listado-personas', 'Persona::index', ['name' => 'listado-personas']);

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
