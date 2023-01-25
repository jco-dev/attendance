<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Asistencia extends BaseController
{
    public function index(): string
    {
        return view('asistencia/marcado');
    }
}
