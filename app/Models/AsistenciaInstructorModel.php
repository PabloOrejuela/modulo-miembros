<?php

namespace App\Models;

use CodeIgniter\Model;

class AsistenciaInstructorModel extends Model {

    protected $DBGroup          = 'default';
    protected $table            = 'asistenciainstructor';
    protected $primaryKey       = 'idasistencia ';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'idusuario', 'fechaClase', 'observaciones'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function _getAsistenciasInstructor($idusuarios){
        $result = NULL;
        $builder = $this->db->table('asistenciainstructor');
        $builder->select('idusuario, nombre, cedula, usuario.idrol as rol, fechaClase, observaciones');
        $builder->where('asistenciainstructor.idusuario', $idusuarios);
        $builder->join('usuario', 'usuario.idusuario=asistenciainstructor.idusuario');  
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result[] = $row;
            }
        }
        //echo $this->db->getLastQuery();
        return $result;
    }
}
