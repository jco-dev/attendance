<?php

namespace Config;

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
    public $validacionPersona = [
        'ci' => [
            'rules' => 'required|min_length[6]|max_length[13]',
        ],
        'expedido' => [
            'rules' => 'required',
        ],
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
            'rules' => 'max_length[50]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+|(^$)/]',
            'errors' => [
                'regex_match' => 'El Apellido Paterno debe contener solo letras.',
            ],
        ],
        'celular' => [
            'rules' => 'required|min_length[8]|max_length[8]|regex_match[/^(7|6)?[0-9]{7}$/]',
            'errors' => [
                'regex_match' => 'El número de celular debe empezar de 6 o 7.'
            ],
        ],
        'correo' => [
            'rules' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[persona.email]',
        ],
    ];
}
