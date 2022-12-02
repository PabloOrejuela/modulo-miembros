<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

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
        $builder->join('paquetes', 'paquetes.idpaquete = membresias.idpaquete');
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result[] = $row;
            }
        }
        //echo $this->db->getLastQuery();exit;
        //echo '<pre>'.var_export($result, true).'</pre>'; exit;
        return $result;
    }

    /**
     * Esta función verifica y actualiza el estado de las membresías por el tiempo de caducidad o la cantidad de asistencias
     */
    function _update_status_all($membresias){
        //echo '<pre>'.var_export($membresias, true).'</pre>'; exit;
        $builder = $this->db->table('membresias');
        
        foreach ($membresias as $row) {
            if ($row->tipo == 1) {
                $fechaActual = date("Y-m-d");
                $fecha_final = $row->fecha_final;

                $diferenciaSegundos = strtotime($fecha_final) - strtotime($fechaActual);
                $diferenciaDias = $diferenciaSegundos / 86400;
                
                //echo '<pre>'.var_export($diferenciaDias, true).'</pre>';
                if ($diferenciaDias <= 0) {
                    //se ha superado la fecha límite de uso
                    $builder->set('status', 0);
                }else{
                    $builder->set('status', 1);
                }
                $builder->where('idmembresias', $row->idmembresias);
                $builder->update();
            }else{
                $fechaActual = date("Y-m-d");
                $fecha_final = $row->fecha_final;

                $diferenciaSegundos = strtotime($fecha_final) - strtotime($fechaActual);
                $diferenciaDias = $diferenciaSegundos / 86400;

                if ($diferenciaDias <= 0 || $row->asistencias >= $row->dias) {
                    //se ha superado la fecha límite de uso
                    $builder->set('status', 0);
                }else{
                    $builder->set('status', 1);
                }
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
        
        foreach ($data as $value) {
            $value->num_asistencias = $this->_get_total_asistencias($value);
            $this->_update_asistencias_membresia($value);
        }
        //echo '<pre>'.var_export($data, true).'</pre>';
    }

    /**
     * Trae las asistencias de una membresía dentro de un rango de fechas
    */
    function _get_total_asistencias($object){
        //echo '<pre>'.var_export($object, true).'</pre>';
        $result = 0;
        $builder = $this->db->table('asistencia');
        $builder->selectSum('num_asistencias', 'total');
        $builder->where('idmembresias', $object->idmembresias);
        $builder->where('updated_at >=', $object->fecha_inicio)->where('updated_at <=', $object->fecha_final);
        //$builder->join('membresias', 'membresias.idmembresias=asistencia.idmembresias');
        $q = $builder->get();
        if ($q->getResult() != null) {
            foreach ($q->getResult() as $row) {
                $result = $row->total;
            }
        }
        return $result;
    }

    /**
     * Actualiza las asistencias de una membresía
     */
    function _update_asistencias_membresia($data){
        //echo '<pre>'.var_export($data, true).'</pre>';
        $builder = $this->db->table('membresias');
        $builder->set('asistencias', $data->num_asistencias);
        $builder->where('idmembresias', $data->idmembresias);
        $builder->update();
    }

    /**
     * Actualiza la fecha final de la membresía
     */
    function _update_fecha_final_membresia($data){
        $this->db->transStart();
        //echo '<pre>'.var_export($data, true).'</pre>';
        $builder = $this->db->table('membresias');
        $builder->set('status', 1);
        $builder->set('fecha_final',  $data['fecha_final']);

        $builder->where('idmembresias', $data['idmembresias']);
        $builder->update();

        $this->_insert_movimiento($data);

        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
        }else {
            $this->db->transCommit();
        }
    }

    function _insert_movimiento($data){
        //echo '<pre>'.var_export($data, true).'</pre>';exit;
        $builder = $this->db->table('movimientos');
        $builder->set('idtipomovimiento', $data['idtipomovimiento']);
        $builder->set('observacion', $data['observacion']);
        $builder->set('idmiembros', $data['idmiembros']);
        $builder->set('idmembresias', $data['idmembresias']);
        $builder->set('idusuarios', $data['idusuarios']);

        $builder->insert();
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
        $this->_insert_movimiento($data);
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            return 0;
        }else{echo 206;
            $this->db->transCommit();
            return 1;
        }
    }
    
}