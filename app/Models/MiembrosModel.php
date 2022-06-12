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

    protected $allowedFields = ['nombre', 'cedula', 'telefono', 'email'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'nombre'     => 'required|min_length[5]',
        'email'        => 'required|valid_email|is_unique[miembros.email]',
        'cedula'        => 'required|is_unique[miembros.cedula]',
    ];
    protected $validationMessages = [
        'nombre'     => [
            'required' => "Lo sentimos, este campo es obligatorio"
        ],
        'email'        => [
            'required' => "Lo sentimos, este campo es obligatorio"
        ],
        'cedula'        => [
            'required' => "Lo sentimos, este campo es obligatorio"
        ],
    ];
    protected $skipValidation   = false;


    function _getMiembros($result = NULL){
        
        $builder = $this->db->table('miembros');
        $builder->select('*');
        $builder->join('membresias', 'miembros.idmiembros = membresias.idmiembros');
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
        $builder->set('cedula', $array['cedula']);
        $builder->set('telefono', $array['telefono']);
        $builder->set('email', $array['email']);
        $builder->where('idmiembros', $array['idmiembros']);
        $builder->update();
        $result = $this->db->getLastQuery();
        return $result;
    }

}