<?php

namespace App\Validation;

class Persona
{
    public function esUnicoCi(string $ci, string $campos, array $data): bool
    {
        $persona = new \App\Models\PersonaModel();
        $registros = $persona->where(['ci' =>  $ci, 'id!=' => $data['id']])->findAll();
        if($registros)
            return false;
        return true;
    }

    public function esUnicoCelular(string $celular, string $campos, array $data): bool
    {
        $persona = new \App\Models\PersonaModel();
        $registros = $persona->where(['celular' =>  $celular, 'id!=' => $data['id']])->findAll();
        if($registros)
            return false;
        return true;
    }

    public function esUnicoCorreo(string $correo, string $campos, array $data): bool
    {
        $persona = new \App\Models\PersonaModel();
        $registros = $persona->where(['correo' =>  $correo, 'id!=' => $data['id']])->findAll();
        if($registros)
            return false;
        return true;
    }

    public function esUnicoRu(string $ru, string $campos, array $data): bool
    {
        $persona = new \App\Models\PersonaModel();
        $registros = $persona->where(['ru' =>  $ru, 'id!=' => $data['id']])->findAll();
        if($registros)
            return false;
        return true;
    }
}
