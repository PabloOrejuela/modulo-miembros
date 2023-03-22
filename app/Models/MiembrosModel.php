<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\AsistenciaModel;


class MiembrosModel extends Model{
   
    protected $table      = 'miembros';
    protected $primaryKey = 'idmiembros';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'num_documento', 'telefono', 'email', 'fecha_nacimiento'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation   = false;


    function _getMiembros($result = NULL){
        
        $builder = $this->db->table('miembros');
        $builder->select('*');
        $builder->orderBy('nombre', 'asc');
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }

    function _update($array){
        
        $result = NULL;
        $builder = $this->db->table('miembros');
        $builder->set('nombre', $array['nombre']);
        $builder->set('num_documento', $array['num_documento']);
        $builder->set('telefono', $array['telefono']);
        $builder->set('email', $array['email']);
        $builder->where('idmiembros', $array['idmiembros']);
        $builder->update();
        $result = $this->db->getLastQuery();
        return $result;
    }

}