<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\SSP;

class Persona extends BaseController
{
    public function index(): string
    {
        return view('persona/index');
    }

    public function ajaxListadoPersona()
    {
        $table = 'ac_vista_listado_personas';
        $primaryKey = 'id';
        $where = NULL;

        $columns = array(
            array('dt' => 0, 'db' => 'id'),
            array('dt' => 1, 'db' => 'ci'),
            array('dt' => 2, 'db' => 'ru'),
            array('dt' => 3, 'db' => 'nombres'),
            array('dt' => 4, 'db' => 'celular'),
            array('dt' => 5, 'db' => 'correo'),
            array('dt' => 6, 'db' => 'estado', 'formatter' => function($fila, $row){
                return "<span class='badge badge-success'>$fila</span>";
            }),
            array('dt' => 7,'db' => 'id', 'formatter' => function($fila, $row){
                return '<div class="dropdown">
                      <button class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Acciones
                      </button>
                      <ul class="dropdown-menu" id="ul-options" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item editar" data-id="'.$fila.'" href="javascript: void(0)">Editar</a></li>
                          <li><a class="dropdown-item eliminar" data-id="'.$fila.'" href="javascript: void(0)">Eliminar</a></li>
                          <li><a class="dropdown-item asignar_horario" data-id="'.$fila.'" href="javascript: void(0)">Asignar Horario</a></li>
                      </ul>
                </div>';
            }),
        );

        $db = \Config\Database::connect();
        $sql_details = [
            'user' => $db->username,
            'pass' => $db->password,
            'db'   => $db->database,
            'host' => $db->hostname,
            'driver' => $db->DBDriver,
        ];
        return $this->response->setJSON(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, null));
    }
}
