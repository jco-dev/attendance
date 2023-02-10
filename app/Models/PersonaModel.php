<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'persona';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'ci',
        'expedido',
        'nombres',
        'paterno',
        'materno',
        'celular',
        'correo',
        'ru',
        'estado'
    ];

    // Dates
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';

    // Funciones
    public function asignaciones($persona_id): array
    {
        $builder = $this->db->table('persona p');
        $builder->select("concat_ws(' ', p.ci, p.expedido) as ci, concat_ws(' ', p.nombres, p.paterno, p.materno) as nombres, a.fecha_inicio, a.fecha_fin,a.estado");
        $builder->join('asignacion_horario a', 'a.persona_id = p.id');
        $builder->where('p.id', $persona_id);
        $query = $builder->get();
        return $query->getResult();
    }
}
