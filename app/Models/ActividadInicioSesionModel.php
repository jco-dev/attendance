<?php

namespace App\Models;

use CodeIgniter\Model;

class ActividadInicioSesionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'actividad_inicio_sesion';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'usuario_id',
        'agente',
        'ip',
        'hora_inicio_sesion',
        'hora_cierre_sesion',
        'estado'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';

}
