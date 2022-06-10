<?php

namespace App\Models;

use CodeIgniter\Model;

class AsistenciaModel extends Model{
    protected $table      = 'asistencia';
    protected $primaryKey = 'idasistencia';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idmembresias'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}