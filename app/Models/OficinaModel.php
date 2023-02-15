<?php

namespace App\Models;

use CodeIgniter\Model;

class OficinaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'oficina';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'persona_id',
        'sede_id',
        'nombre',
        'descripcion',
        'ip',
        'estado'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';

}
