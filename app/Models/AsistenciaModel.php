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

    public function obtenerAsistenciaMes($personaId, $mes, $anio)
    {
        $builder= $this->db->table('asistencia a');
        $builder->select('a.id as id_asistencia, a.entrada, a.salida, a.fecha ');
        $builder->join('asignacion_horario ah', 'ah.id=a.asignacion_horario_id');
        $builder->where('ah.persona_id', $personaId);
        $builder->where("date_part('MONTH', a.fecha) = '$mes'", null, false);
        $builder->where("date_part('YEAR', a.fecha) = '$anio'", null, false);
        $builder->orderBy('a.fecha', 'ASC');
        $query = $builder->get();
        return $query->getResult();

    }

    public function verificarMarcadoFecha($fecha,$personaId)
    {
        $builder = $this->db->table('asistencia a');
        $builder->select('a.id as id_asistencia, a.entrada,  a.fecha ');
        $builder->join('asignacion_horario ah', 'ah.id=a.asignacion_horario_id');
        $builder->where('ah.persona_id', $personaId);
        $builder->where('a.fecha', $fecha);
        $query = $builder->get();
        return $query->getRow();
    }

    public function actualizarMarcado($marcadoId, $hora)
    {
        $builder = $this->db->table('asistencia');
        $builder->set('salida', $hora);
        $builder->where('id', $marcadoId);
        $builder->update();

        return $this->db->affectedRows();
    }
}
