<?php

namespace App\Models;

use CodeIgniter\Model;

class SedeModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'sede';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'object';
    protected $protectFields = true;
    protected $allowedFields = [
        'denominacion_sede',
        'descripcion_sede',
        'latitud',
        'longitud'
    ];
}
