<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\SSP;
use App\Models\OficinaModel;
use App\Models\PersonaModel;
use App\Models\SedeModel;
use ReflectionException;

class Oficina extends BaseController
{
    public OficinaModel $model;
    public function __construct()
    {
        $this->model = new OficinaModel();
    }
    public function index(): string
    {
        $data['personas'] = (new PersonaModel())->where('estado', 'REGISTRADO')->findAll();
        $data['sedes'] = (new SedeModel())->where('estado', 'REGISTRADO')->findAll();
        return view('oficina/index', $data);
    }

    public function ajaxListadoOficina(): \CodeIgniter\HTTP\ResponseInterface
    {
        $table = "(SELECT ac.id, ac.nombre, ac.descripcion, ac.persona_id, CONCAT_WS(' ', ap.nombres, ap.paterno, ap.materno) AS encargado, 
                    ac.sede_id,  asd.denominacion_sede, ac.estado, ac.creado_el FROM ac_oficina ac
                    INNER JOIN ac_sede asd ON asd.id = ac.sede_id
                    INNER JOIN ac_persona ap ON ap.id = ac.persona_id AND ac.estado = 'REGISTRADO') as temp";

        $primaryKey = 'id';
        $where = NULL;

        $columns = array(
            array('dt' => 0, 'db' => 'id'),
            array('dt' => 1, 'db' => 'nombre'),
            array('dt' => 2, 'db' => 'descripcion'),
            array('dt' => 3, 'db' => 'encargado'),
            array('dt' => 4, 'db' => 'denominacion_sede'),
            array('dt' => 5, 'db' => 'estado', 'formatter' => function ($fila, $row) {
                if ($fila == 'REGISTRADO')
                    return "<span class='badge badge-success'>$fila</span>";
                else
                    return "<span class='badge badge-danger'>$fila</span>";
            }),
            array('dt' => 6, 'db' => 'id', 'formatter' => function ($fila, $row) {
                return '<div class="dropdown">
                      <button class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Acciones
                      </button>
                      <ul class="dropdown-menu" id="ul-options" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item editar" data-id="' . $fila . '" href="javascript: void(0)">Editar</a></li>
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

    public function edit(): \CodeIgniter\HTTP\ResponseInterface
    {
        if($oficina = (new OficinaModel())->where('id', $this->request->getPost('id'))->first())
            return $this->response->setJSON($oficina);
        else
            return $this->response->setJSON(NULL);
    }

    /**
     * @throws ReflectionException
     */
    public function update(): \CodeIgniter\HTTP\ResponseInterface
    {
        if(!$this->validate('validacionEditarOficina'))
            return $this->response->setJSON(['error' => $this->validator->getErrors()]);
        $datos = [
            'persona_id' => $this->request->getPost('persona_id'),
            'sede_id' => $this->request->getPost('sede_id'),
            'nombre' => trim($this->request->getPost('nombre')),
            'descripcion' => trim($this->request->getPost('descripcion')),
            'ip' => trim($this->request->getPost('ip'))
        ];

        if($this->model->update($this->request->getPost('persona_id'), $datos)){
            return $this->response->setJSON(['exito' => 'Oficina actualizada correctamente']);
        }

        return $this->response->setJSON(['error' => 'Error al actualizar oficina.']);
    }
}
