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
        'ru'
    ];

    // Dates
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';
}
