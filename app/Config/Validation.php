<?php

namespace Config;

use App\Validation\Persona;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        Persona::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public array $validacionPersona = [
        'ci' => ['rules' => 'required|min_length[6]|max_length[13]|is_unique[persona.ci]',],
        'expedido' => ['rules' => 'required',],
        'nombres' => [
            'rules' => 'required|min_length[3]|max_length[50]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/]',
            'errors' => [
                'regex_match' => 'El nombre(s) debe contener solo letras.',
            ],
        ],
        'paterno' => [
            'rules' => 'required|min_length[3]|max_length[50]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/]',
            'errors' => [
                'regex_match' => 'El Apellido Paterno debe contener solo letras.',
            ],
        ],
        'materno' => [
            'rules' => 'max_length[50]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/]|permit_empty',
            'errors' => [
                'regex_match' => 'El Apellido Paterno debe contener solo letras.',
            ],
        ],
        'celular' => [
            'rules' => 'required|min_length[8]|max_length[8]|regex_match[/^(7|6)?[0-9]{7}$/]|is_unique[persona.celular])',
            'errors' => [
                'regex_match' => 'El número de celular debe empezar de 6 o 7.'
            ],
        ],
        'correo' => ['rules' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[persona.correo]',],
        'ru' => ['rules' => 'permit_empty|is_unique[persona.ru]']
    ];

    public array $validacionEditarPersona = [
        'ci'        => ['rules' => 'required|min_length[6]|max_length[13]|esUnicoCi[ci]', 'errors' => ['esUnicoCi' => 'El número de cédula de identidad ya se encuentra registrado.']],
        'expedido'  => ['rules' => 'required',],
        'nombres'   => ['rules' => 'required|min_length[3]|max_length[50]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/]',],
        'paterno'   => ['rules' => 'required|min_length[3]|max_length[50]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/]',],
        'materno'   => ['rules' => 'max_length[50]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/]|permit_empty',],
        'celular'   => ['rules' => 'required|min_length[8]|max_length[8]|regex_match[/^(7|6)?[0-9]{7}$/]|esUnicoCelular[celular])', 'errors' => ['esUnicoCelular' => 'El número ya se encuentra registrado.']],
        'correo'    => ['rules' => 'required|min_length[6]|max_length[50]|valid_email|esUnicoCorreo[correo]', 'errors' => ['esUnicoCorreo' => 'El correo electrónico ya se encuentra registrado.']],
        'ru'        => ['rules' => 'permit_empty|esUnicoRu[ru]', 'errors'=> ['esUnicoRu' => 'El ru ya se encuentra registrado.']]
    ];

}
