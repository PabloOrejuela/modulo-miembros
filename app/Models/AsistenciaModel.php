<?php

namespace App\Models;

use CodeIgniter\Model;

class AsistenciaModel extends Model{
    protected $table      = 'asistencia';
    protected $primaryKey = 'idasistencia';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'idmembresias', 'num_asistencias', 'codigos_multipases'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    private function _get_last_attend($idmembresias){
        $last = $this->builder->where('idmembresias', $idmembresias)->orderBy('idasistencia', 'DESC')->limit(1);
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
    
    public function _insert_asistencia($data){
        $this->db->transStart();
        $builder = $this->db->table('asistencia');
        $builder->set('idmembresias', $data['idmembresias']);
        $builder->set('num_asistencias', $data['num_asistencias']);
        $builder->set('codigos_multipases', $data['codigos_multipases']);
        $builder->insert();
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            return 0;
        }else{
            return 1;
        }
    }
}