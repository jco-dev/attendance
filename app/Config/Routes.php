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

$routes->group("", ['filter' => 'auth:superadmin,admin'], function ($routes) {
    /** Persona */
    $routes->get('listado-personal', 'Persona::index', ['name' => 'listado-personal']);
    $routes->get('ajax-listado-personas', 'Persona::ajaxListadoPersona', ['name' => 'ajax-listado-personas']);
    $routes->post('guardar-persona', 'Persona::store', ['name' => 'guardar-persona']);
    $routes->post('verificar-registro-ci-persona', 'Persona::verificarRegistroPersonaCi', ['name' => 'verificar-registro-ci-persona']);
    $routes->post('editar-persona', 'Persona::edit', ['name' => 'editar-persona']);
    $routes->post('actualizar-persona', 'Persona::update', ['name' => 'actualizar-persona']);
    $routes->post('eliminar-persona', 'Persona::eliminarPersona', ['name' => 'eliminar-persona']);
    $routes->post('activar-persona', 'Persona::activarPersona', ['name' => 'activar-persona']);
    $routes->post('ver-asignaciones-horario', 'Persona::verAsignacionesHorario', ['name' => 'ver-asignaciones-horario']);

    /** Oficina */
    $routes->get('listado-oficinas', 'Oficina::index', ['name' => 'listado-oficinas']);
    $routes->get('ajax-listado-oficinas', 'Oficina::ajaxListadoOficina', ['name' => 'ajax-listado-oficinas']);
    $routes->post('editar-oficina', 'Oficina::edit', ['name' => 'editar-oficina']);
    $routes->post('actualizar-oficina', 'Oficina::update', ['name' => 'actualizar-oficina']);
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
