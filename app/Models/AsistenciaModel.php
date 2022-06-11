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

    private function _get_last_attend($idmembresias){
        $last = $builder->where('idmembresias', $idmembresias)->orderBy('idasistencia', 'DESC')->limit(1);
        echo $last;
    }

    public function _get_all_attend($idmembresias){
        $result = null;
        $db = \Config\Database::connect();
        $builder = $db->table('asistencia');
        $builder->select('idasistencia');
        $builder->where('idmembresias', $idmembresias);
        $query = $builder->get();
        foreach ($query->getResult() as $row) {
            $result[] = $row;
        }
     
        return $result;
    }    
}