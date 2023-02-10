<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PersonaModel;
use App\Libraries\SSP;
use ReflectionException;

class Persona extends BaseController
{
    public $model;

    public function __construct()
    {
        $this->model = new PersonaModel();
    }

    public function index(): string
    {
        return view('persona/index');
    }

    public function ajaxListadoPersona(): \CodeIgniter\HTTP\ResponseInterface
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
            array('dt' => 6, 'db' => 'estado', 'formatter' => function ($fila, $row) {
                if ($fila == 'REGISTRADO')
                    return "<span class='badge badge-success'>$fila</span>";
                else
                    return "<span class='badge badge-danger'>$fila</span>";
            }),
            array('dt' => 7, 'db' => 'id', 'formatter' => function ($fila, $row) {
                $activar = '';
                if ($row['estado'] == 'ELIMINADO')
                    $activar = '<li><a class="dropdown-item activar" data-id="' . $fila . '" data-nombre=" ' . $row['nombres'] . '" href="javascript: void(0)">Activar</a></li>';
                $eliminar = '';
                if ($row['estado'] == 'REGISTRADO')
                    $eliminar = '<li><a class="dropdown-item eliminar" data-id="' . $fila . '" data-nombre=" ' . $row['nombres'] . '" href="javascript: void(0)">Eliminar</a></li>';

                return '<div class="dropdown">
                      <button class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Acciones
                      </button>
                      <ul class="dropdown-menu" id="ul-options" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item editar" data-id="' . $fila . '" href="javascript: void(0)">Editar</a></li>' . $activar . '
                          ' . $eliminar . '
                          <li><a class="dropdown-item asignar_horario" data-id="' . $fila . '" href="javascript: void(0)">Ver asignaciones de horario</a></li>
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

    /**
     * @throws ReflectionException
     */
    public function store(): \CodeIgniter\HTTP\ResponseInterface
    {
        if (!$this->validate('validacionPersona'))
            return $this->response->setJSON(['error' => $this->validator->getErrors()]);

        if ($this->model->insert($this->getArr()))
            return $this->response->setJSON(['exito' => 'Personal Registrado correctamente.']);

        return $this->response->setJSON(['error' => 'Error al registrar el personal.']);
    }

    public function verificarRegistroPersonaCi(): \CodeIgniter\HTTP\ResponseInterface
    {
        $ci = $this->request->getPost('ci');
        $persona = new PersonaModel();
        if ($persona->where('ci', trim($ci))->find())
            $respuesta = true;
        else
            $respuesta = false;
        return $this->response->setJSON($respuesta);
    }

    public function edit(): \CodeIgniter\HTTP\ResponseInterface
    {
        $id = $this->request->getPost('id');
        if ($persona = (new PersonaModel())->where('id', $id)->first())
            return $this->response->setJSON($persona);
        else
            return $this->response->setJSON(NULL);
    }

    /**
     * @throws ReflectionException
     */
    public function update(): \CodeIgniter\HTTP\ResponseInterface
    {
        if (!$this->validate('validacionEditarPersona'))
            return $this->response->setJSON(['error' => $this->validator->getErrors()]);

        if ($this->model->update($this->request->getPost('id'), $this->getArr()))
            return $this->response->setJSON(['exito' => 'Datos actualizados correctamente.']);

        return $this->response->setJSON(['error' => 'Error al editar los datos de la persona.']);
    }

    /**
     * @return array
     */
    public function getArr(): array
    {
        return [
            'ci' => trim($this->request->getPost('ci')),
            'expedido' => $this->request->getPost('expedido'),
            'ru' => $this->request->getPost('ru'),
            'nombres' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('nombres'))), MB_CASE_UPPER),
            'paterno' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('paterno'))), MB_CASE_UPPER),
            'materno' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('materno'))), MB_CASE_UPPER),
            'celular' => trim($this->request->getPost('celular')),
            'correo' => trim($this->request->getPost('correo'))
        ];
    }

    /**
     * @throws ReflectionException
     */
    public function eliminarPersona(): \CodeIgniter\HTTP\ResponseInterface
    {
        $id = $this->request->getPost('id');

        if ($this->model->update($id, ['estado' => 'ELIMINADO']))
            return $this->response->setJSON(['exito' => 'Persona eliminado correctamente.']);
        else
            return $this->response->setJSON(['error' => 'Error al eliminar el personal.']);
    }

    /**
     * @throws ReflectionException
     */
    public function activarPersona(): \CodeIgniter\HTTP\ResponseInterface
    {
        $id = $this->request->getPost('id');

        if ($this->model->update($id, ['estado' => 'REGISTRADO']))
            return $this->response->setJSON(['exito' => 'Persona activado correctamente.']);
        else
            return $this->response->setJSON(['error' => 'Error al activar el estado de la persona.']);
    }

    public function verAsignacionesHorario(): \CodeIgniter\HTTP\ResponseInterface
    {
        $persona_id = $this->request->getPost('id');
        $asignaciones = $this->model->asignaciones($persona_id);
        $table = '<div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>#</th>
                        <th>ci</th>
                        <th>Nombres</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>';
        if ($asignaciones) {
            foreach ($asignaciones as $key => $a) {
                if ($a->estado == 'REGISTRADO')
                    $a->estado = '<span class="badge badge-success">REGISTRADO</span>';
                else
                    $a->estado = '<span class="badge badge-danger">TERMINADO</span>';
                $table .= '<tr>
                        <td>' . ($key + 1) . '</td>
                        <td>' . $a->ci . '</td>
                        <td>' . $a->nombres . '</td>
                        <td>' . $a->fecha_inicio . '</td>
                        <td>' . $a->fecha_fin . '</td>
                        <td>' . $a->estado . '</td>
                    </tr>';
            }
        } else {
            $table .= '<tr>
                <td colspan="6" class="text-center">No hay asignaciones de horario registradas.</td>
            </tr>';
        }
        $table .= '</tbody>
            </table>
        </div>';
        return $this->response->setJSON(['exito' => $table]);
    }
}
