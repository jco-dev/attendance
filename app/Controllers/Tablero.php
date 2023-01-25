<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Tablero extends BaseController
{
    public function index(): string
    {
        return view('tablero/inicio');
    }
}
