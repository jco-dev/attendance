<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\SSP;

class AsignacionHorario extends BaseController
{
    public function index(): string
    {
        return view('asignacionHorario/index');
    }
    public function ajaxListadoAsignacionHorario(): \CodeIgniter\HTTP\ResponseInterface
    {
        $table = "(SELECT aah.id,
                    CONCAT_WS(' ', ap.ci, ap.expedido) AS ci, 
                    CONCAT_WS(' ', ap.nombres, ap.paterno, ap.materno) AS nombres,
                    (SELECT atp.tipo FROM ac_tipo_personal atp WHERE atp.id = aah.tipo_personal_id) AS tipo_personal,
                    (SELECT at2.turno FROM ac_turno at2 WHERE at2.id = aah.turno_id) AS turno,
                    TO_CHAR((SELECT at2.entrada FROM ac_turno at2 WHERE at2.id = aah.turno_id), 'HH12:MI PM') AS entrada,
                    (SELECT ROUND(SUM(EXTRACT(EPOCH FROM (aa.salida  - aa.entrada))/3600), 0) || ' horas'  AS total_horas
                    FROM ac_asistencia aa 
                    WHERE aa.asignacion_horario_id = aah.id) AS total_horas,
                    (SELECT ao.nombre  FROM ac_oficina ao where ao.id = aah.oficina_id) AS oficina,
                    TO_CHAR(aah.fecha_inicio, 'DD/MM/YYYY') AS fecha_inicio,
                    TO_CHAR(aah.fecha_fin, 'DD/MM/YYYY') AS fecha_fin,
                    aah.estado	
                    FROM ac_persona ap JOIN ac_asignacion_horario aah ON ap.id=aah.persona_id ORDER BY 4, 3) AS temp";

        $primaryKey = 'id';
        $where = NULL;

        $columns = array(
            array('dt' => 0, 'db' => 'id'),
            array('dt' => 1, 'db' => 'ci'),
            array('dt' => 2, 'db' => 'nombres'),
            array('dt' => 3, 'db' => 'tipo_personal'),
            array('dt' => 4, 'db' => 'turno'),
            array('dt' => 5, 'db' => 'entrada'),
            array('dt' => 6, 'db' => 'total_horas'),
            array('dt' => 7, 'db' => 'oficina'),
            array('dt' => 8, 'db' => 'fecha_inicio'),
            array('dt' => 9, 'db' => 'fecha_fin'),
            array('dt' => 10, 'db' => 'estado', 'formatter' => function ($fila, $row) {
                if ($fila == 'REGISTRADO')
                    return "<span class='badge badge-success'>$fila</span>";
                else
                    return "<span class='badge badge-danger'>$fila</span>";
            }),
            array('dt' => 11, 'db' => 'id', 'formatter' => function ($fila, $row) {
                return '<div class="dropdown">
                      <button class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Acciones
                      </button>
                      <ul class="dropdown-menu shadow-lg" id="ul-options" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item editar" data-id="' . $fila . '" href="javascript: void(0)"><i class="fa fa-print"></i>  Imprimir Tarjeta</a></li>
                          <li><a class="dropdown-item editar" data-id="' . $fila . '" href="javascript: void(0)"><i class="fa fa-pencil"></i>  Editar</a></li>
                          <li><a class="dropdown-item editar" data-id="' . $fila . '" href="javascript: void(0)"><i class="fa fa-calendar-times"></i>  Finalizar Asignación horario</a></li>
                          <li><a class="dropdown-item editar" data-id="' . $fila . '" href="javascript: void(0)"><i class="fa fa-print"></i>  Imprimir Informe</a></li>
                      </ul>
                </div>';
            }),
        );

        $db = \Config\Database::connect();
        $sql_details = [
            'user' => $db->username,
            'pass' => $db->password,
            'db' => $db->database,
            'host' => $db->hostname,
            'driver' => $db->DBDriver,
        ];

        return $this->response->setJSON(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, null));

    }
}
