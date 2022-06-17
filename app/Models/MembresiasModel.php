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
    /**
     * Esta función verifica y actualiza el estado de las membresías por el tiempo de caducidad
     */
    function _update_status_all($membresias){
        //echo '<pre>'.var_export(date('Y-m-d'), true).'</pre>';
        $builder = $this->db->table('membresias');
        
        foreach ($membresias as $row) {
            if ($row->fecha_final <= date('Y-m-d') || ($row->total - $row->asistencias) == 0) {
                $builder->set('status', 0);
                $builder->where('idmembresias', $row->idmembresias);
                $builder->update();
            }
        }
        return 1;
    }

    /*
     * Trae toda la información de una memnbresía para la edición 
     */
    function _getMembresia($idmembresias){
        
        $db = \Config\Database::connect();
        $builder = $db->table('membresias');
        $builder->select('*');
        $builder->join('miembros', 'miembros.idmiembros = membresias.idmiembros');
        $builder->where('idmembresias', $idmembresias);
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }
    
}