<?php

namespace App\Models;

use CodeIgniter\Model;

class MembresiasModel extends Model{
    protected $table      = 'membresias';
    protected $primaryKey = 'idmembresias';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idpaquete', 'idmiembros', 'fecha_inicio', 'fecha_final', 'asistencias', 'saldo'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function _getMembresias($result = NULL){
        
        $db = \Config\Database::connect();
        $builder = $db->table('membresias');
        $builder->select('*');
        $builder->join('miembros', 'miembros.idmiembros = membresias.idmiembros');
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }
    
}