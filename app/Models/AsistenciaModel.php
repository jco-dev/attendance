<?php

namespace App\Models;

use CodeIgniter\Model;

class AsistenciaModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'asistencia';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $protectFields = true;
    protected $allowedFields = [
        'asignacion_horario_id',
        'usuario_id',
        'entrada',
        'salida',
        'fecha',
        'estado',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'creado_el';
    protected $updatedField = 'actualizado_el';

    // Funciones //
    public function obtenerIpOficina($persona_id)
    {
        $builder = $this->db->table('asignacion_horario');
        $builder->select('ip');
        $builder->join('oficina', 'oficina.id=asignacion_horario.oficina_id');
        $builder->where('asignacion_horario.persona_id', $persona_id);
        $builder->where('asignacion_horario.estado', 'REGISTRADO');
        $query = $builder->get();
        return $query->getRow();
    }
}
