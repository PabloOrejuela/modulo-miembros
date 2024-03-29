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
	
	public $newMember = [
        'nombre'  => 'required|min_length[5]',
        'email'   => 'required|valid_email|is_unique[miembros.email]',
        'cedula'  => 'required|is_unique[miembros.cedula]',
        'telefono'   => 'required',
        'fecha_nacimiento'   => 'required|valid_date',

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

    public $newUser = [
        'nombre'  => 'required|min_length[5]',
        'email'   => 'required|valid_email|is_unique[usuarios.email]',
        'cedula'  => 'required|is_unique[usuarios.cedula]',
        'telefono'   => 'required',
        'idroles'   => 'required|greater_than[0]',

    ];

    public $newUser_errors = [
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
        'idroles' => [
            'required' => 'El campo {field} es obligatorio',
            'greater_than' => 'El campo {field} es obligatorio'
        ],
    ];

    public $updateUser = [
        'nombre'  => 'required|min_length[5]',
        'email'   => 'required|valid_email',
        'cedula'  => 'required',
        'user'  => 'required|min_length[3]',
        'telefono'   => 'required',
        'idroles'   => 'required|greater_than[0]',

    ];

    public $login = [
        'user'  => 'required',
        'password'   => 'required',
    ];

    public $login_errors = [
        'user' => [
            'required' => 'El campo "Usuario" es obligatorio',
        ],
        'password' => [
            'required' => 'El campo "Contraseña" es obligatorio',
        ]
    ];

    public $asistenciaInstructor = [
        'cedula'  => 'required'
    ];

    public $asistenciaInstructor_errors = [
        'cedula' => [
            'required' => 'El campo "Cédula" es obligatorio',
        ]
    ];

    public $asigna_membresia = [
        'idpaquete'     => 'required|greater_than[0]',
        'idmiembros'     => 'required',
    ];

    public $asigna_membresia_errors = [
        'idpaquete' => [
            'required' => 'El campo "Paquete" es obligatorio',
            'greater_than' => 'El campo "Paquete" es obligatorio',
        ],
        'idmiembros' => [
            'required' => 'El campo "Miembro" es obligatorio',
        ]
    ];

    public $transfiere_membresia = [
        'idmiembros'     => 'required|greater_than[0]',
        'idmembresias'     => 'required',
    ];

    public $transfiere_membresia_errors = [
        'idmiembros' => [
            'required' => 'Debe elegir un miembro para transferir la membresía',
            'greater_than' => 'Debe elegir un miembro para transferir la membresía',
        ],
        'idmembresias' => [
            'required' => 'Hubo un error comuniquese con el administrador del sistema',
        ]
    ];

    public $ReporteAsistenciaInstructores = [
        'fecha_desde'     => 'required|valid_date',
        'fecha_hasta'     => 'required|valid_date',
        'idusuarios'     => 'required|integer',
    ];

    public $ReporteAsistenciaInstructores_errors = [
        'fecha_desde' => [
            'required' => 'Debe elegir una fecha inicial para el reporte',
            'valid_date' => 'La fecha "Desde" no tiene un formato correcto',
        ],
        'fecha_hasta' => [
            'required' => 'Debe elegir una fecha final para el reporte',
            'valid_date' => 'La fecha "Hasta" no tiene un formato correcto',
        ],
        'idusuarios' => [
            'required' => 'Es obligatorio elegir un instructor para generar el reporte',
            'integer' => 'Hay un error al elegir un usuario, contacte al administrador del sistema',
        ],
    ];
}
