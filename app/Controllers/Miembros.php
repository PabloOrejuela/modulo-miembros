<?php

namespace App\Controllers;

class Miembros extends BaseController{


    public function index(){

        $data['miembros'] = $this->miembrosModel->_getMiembros();
        
        //echo '<pre>'.var_export($data['membresias'], true).'</pre>';

        //$data['result'] = suma(3, 5);
        $data['version'] = $this->CI_VERSION;

        $data['title']='Módulo miembros';
        $data['main_content']='miembros/miembros_view';
        return view('includes/template', $data);
    }
    
    public function new($data = NULL){

        $data['paquetes'] = $this->paquetesModel->find();

        $data['title']='Registrar nuevo miembro';
        $data['main_content']='miembros/frm_nuevo_miembro';
        return view('includes/template', $data);
    }

    public function insert($data = NULL){
        
        $request = \Config\Services::request();

        $data = array(
            'nombre' => $this->request->getPostGet('nombre'),
            'cedula' => $this->request->getPostGet('cedula'),
            'telefono' => $this->request->getPostGet('telefono'),
            'email' => $this->request->getPostGet('email'),
            'idpaquete' => $this->request->getPostGet('idpaquete')
        );
        
//PABLO: Implementar las validaciones
        // if($miembrosModel->save($data) === false){
        //     var_dump($miembrosModel->errors());
        // }else{
            $this->miembrosModel->save($data);
            $idmiembros = $db->insertID();
            
            $paquete = $this->paquetesModel->find($data['idpaquete']);

            $fecha_inicio = date("Y-m-d"); 
            $fecha_final = date("Y-m-d",strtotime($fecha_inicio."+ ".$paquete->dias." days")); 

            $membresia = array(
                'idpaquete' => $data['idpaquete'],
                'idmiembros' => $idmiembros,
                'fecha_inicio' => date("Y-m-d"),
                'fecha_final' => $fecha_final,
                'saldo' => $paquete->entradas,
            );
            $this->membresiasModel->save($membresia);
            return redirect()->to('/');
        //}  
        
    }

    public function editar($idmiembros){
        
        $data['paquetes'] = $this->paquetesModel->find();
        $data['datos'] = $this->miembrosModel->find($idmiembros);
        //$data['lastQuery'] = $this->db->getLastQuery();

        $data['title']='Editar nuevo miembro';
        $data['main_content']='miembros/frm_edit_miembro';
        return view('includes/template', $data);
    }

    public function update(){        
//PABLO Implementar la validación
        $data = [
            'idmiembros' => $this->request->getPostGet('idmiembros'),
            'nombre' => $this->request->getPostGet('nombre'),
            'cedula' => $this->request->getPostGet('cedula'),
            'telefono' => $this->request->getPostGet('telefono'),
            'email' => $this->request->getPostGet('email'),
        ];
        echo '<pre>'.var_export($data, true).'</pre>';
        $lastQuery = $this->miembrosModel->_update($data);
        
        return redirect()->to('/');
    }

}
