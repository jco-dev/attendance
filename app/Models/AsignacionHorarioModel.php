<?php

namespace App\Models;

use CodeIgniter\Model;

class AsignacionHorarioModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'asignacion_horario';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'persona_id',
        'unidad_id',
        'turno_id',
        'oficina_id',
        'tipo_personal_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'nro_correlativo',
        'area_id',
        'gestion_id',
        'semestre_gestion_id'
    ];

    // Dates
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';
}
