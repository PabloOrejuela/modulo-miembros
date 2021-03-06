<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
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
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $newMember = [
        'nombre'  => 'required|min_length[5]',
        'email'   => 'required|valid_email|is_unique[miembros.email]',
        'cedula'  => 'required|is_unique[miembros.cedula]',
        'telefono'   => 'required',
    ];

    public $newMember_errors = [
        'nombre' => [
            'required' => 'El campo {field} es obligatorio',
            'min_length' => 'El campo {field} debe tener almenos 5 caracteres',
        ],
        'cedula' => [
            'required' => 'El campo {field} es obligatorio',
            'is_unique' => 'Esta {field} ya está siendo usada por otra persona',
        ],
        'email' => [
            'required' => 'El campo {field} es obligatorio',
            'valid_email' => 'Debe ingresar un {field} válido',
            'is_unique' => 'Este {field} ya está siendo usado por otra persona',
        ],
        'telefono' => [
            'required' => 'El campo {field} es obligatorio'
        ],
    ];
}
