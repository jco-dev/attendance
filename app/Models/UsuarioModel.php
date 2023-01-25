<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'usuario';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'persona_id',
        'usuario',
        'clave',
        'actualizado_el',
        'estado',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';

    /** Funciones */
    public function buscarUsuarioPorCorreo($correo)
    {
        $builder = $this->db->table('persona p');
        $builder->select('*');
        $builder->join('usuario u', 'p.id=u.persona_id');
        $builder->where('p.correo', $correo);
        $builder->where('u.estado', 'ACTIVE');

        $query = $builder->get();
        return $query->getRowObject();
    }

    public function obtenerGrupoIdPersona($persona_id)
    {
        return $this->db->table('grupo_usuario')
            ->where('usuario_id', $persona_id)
            ->get()
            ->getRowArray();
    }

    public function obtenerGrupoUsuario($id): array
    {
        $builder = $this->db->table('grupo_usuario ug');
        $builder->select('g.nombre_grupo');
        $builder->join('grupo g', 'ug.grupo_id = g.id');
        $builder->where('ug.usuario_id', $id);
        $query = $builder->get();
        return $query->getResult();
    }

}
