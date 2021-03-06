<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;

class Membresia extends BaseController{

    public function index(){

        $data['membresias'] = $this->membresiasModel->_getMembresias();
        $this->membresiasModel->_update_status_all($data['membresias']);
        $this->membresiasModel->_update_cantidad_usos_membresia($data['membresias']);
        $data['membresias'] = $this->membresiasModel->_getMembresias();
        //echo '<pre>'.var_export($data['membresias'], true).'</pre>';
        $data['version'] = $this->CI_VERSION;

        $data['title']='Lista de membresías';
        $data['main_content']='membresias/membresias_view';
        return view('includes/template', $data);
    }

    public function edit($idmembresias){
        $data['membresia'] = $this->membresiasModel->_getMembresia($idmembresias);
        //echo '<pre>'.var_export($data['membresia'], true).'</pre>';

        $data['title']='Edición de membresías';
        $data['main_content']='membresias/frm_edit_membresias_view';
        return view('includes/template', $data);
    }

    /**
     * Actualiza la fecha final de una membresía
     */

     public function update_date(){
        
        $data = [
            'fecha_inicio' => $this->request->getPostGet('fecha_inicio'),
            'fecha_final' => $this->request->getPostGet('fecha_final'),
            'idmembresias' => $this->request->getPostGet('idmembresias'),
            'tipo' => $this->request->getPostGet('tipo'),
        ];

        $fecha_inicio = Time::parse($data['fecha_inicio']);
        $fecha_final  = Time::parse($data['fecha_final']);

        $diff = $fecha_inicio->difference($fecha_final);
        //$data['total']= date("Y-m-d",strtotime($fecha_inicio."+ ".$paquete->dias." days")); 
        $data['total'] = $diff->getDays();;
        //echo '<pre>'.var_export($data['total'], true).'</pre>';
        $lastQuery = $this->membresiasModel->_update_fecha_final_membresia($data);
        
        return redirect()->to('membresias');
        
     }

     /**
      * Form para seleccionar la membresía que se desea transferir
      */
     public function frm_select_transfer(){
        $data['membresias'] = $this->membresiasModel->_getMembresias();
        $this->membresiasModel->_update_status_all($data['membresias']);

        //echo '<pre>'.var_export($data['membresias'], true).'</pre>';

        $data['title']='Tranferir membresías';
        $data['main_content']='membresias/frm_transfer_membresias_view';
        return view('includes/template', $data);
     }

     /**
      * Frm para selecccionar el miembro al que se le desea transferir la membresía
      */
      public function fr_select_member_transfer_membership($idmembresias){

        $data['membresia'] = $this->membresiasModel->_getMembresia($idmembresias);
        $data['miembros'] = $this->miembrosModel->_getMiembros();
        //echo '<pre>'.var_export($data['total'], true).'</pre>';
        $data['title']='Tranferir membresía';
        $data['main_content']='membresias/frm_transfiere_membresia';
        return view('includes/template', $data);
        
     }

     /**
      * Transfiere le membresía al usuario
      */
      public function transfer_membership($idmembresias, $idmiembros){

        //echo '<pre>'.var_export($idmiembros, true).'</pre>';
        $data = [
            'idmembresias' => $idmembresias,
            'idmiembros' => $idmiembros
        ];

        //LLamo a la funcion del modelo que transfiere la membresía
        $result = $this->membresiasModel->_transfiere_membresia($data);
        if ($result == NULL) {
            echo $lastQuery;
        }else{
            return redirect()->to('membresias');
        }
    }
     
}
