<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Persona extends BaseController
{
    public function index(): string
    {
        return view('persona/index');
    }
}
