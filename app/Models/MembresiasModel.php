<?php

namespace App\Models;

use CodeIgniter\Model;

class MembresiasModel extends Model{
    protected $table      = 'membresias';
    protected $primaryKey = 'idmembresias';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idpaquete', 'idmiembros', 'fecha_inicio', 'fecha_final', 'asistencias', 'total','status'];

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
        $result = null;
        $builder = $this->db->table('membresias');
        $builder->select('*');
        $builder->join('miembros', 'miembros.idmiembros = membresias.idmiembros');
        $builder->join('paquetes', 'paquetes.idpaquete = membresias.idpaquete');
        $builder->where('idmembresias', $idmembresias);
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result = $row;
            }

        }
        return $result;
    }

    /**
     * Actualiza la cantidad de entradas de una membresía
     */
    function _update_cantidad_usos_membresia($data){
        return 1;
    }

    /**
     * Actualiza la fecha final de la membresía
     */
    function _update_fecha_final_membresia($data){
        //echo '<pre>'.var_export($data, true).'</pre>';
        $builder = $this->db->table('membresias');
        $builder->set('status', 1);
        $builder->set('fecha_final',  $data['fecha_final']);
        if ($data['tipo'] == 1) {
            $builder->set('total',  $data['total']);
        }
        $builder->where('idmembresias', $data['idmembresias']);
        $builder->update();
    }

    function _obtenCiudad($provincia){
        $this->db->select('*');
        $this->db->where('id_provincia', $provincia);
        $this->db->order_by('ciudad', 'ASC');
        $q = $this->db->get('ciudad');
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $r) {
                $ciudades[] = $r;
            }
            return $ciudades;
        }else{
                return 0;
        }
    }

    /**
     * Actualiza la membresía con el nuevo miembro
     */
    function _transfiere_membresia($data){
        //echo '<pre>'.var_export($data, true).'</pre>';exit;
        $this->db->transStart();
        $builder = $this->db->table('membresias');
        $builder->set('idmiembros', $data['idmiembros']);
        $builder->where('idmembresias', $data['idmembresias']);
        $builder->update();
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            return 0;
        }else{
            return 1;
        }
    }
    
}