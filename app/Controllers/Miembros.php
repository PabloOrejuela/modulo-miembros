<?php

namespace App\Controllers;
use App\Models\MiembrosModel;
use App\Models\PaquetesModel;
use App\Models\MembresiasModel;
use App\Models\AsistenciaModel;

class Miembros extends BaseController{

    public function __construct(){
        
    }

    public function index(){

        $miembrosModel = new MiembrosModel($db);
        $data['miembros'] = $miembrosModel->_getMiembros();
        
        //echo '<pre>'.var_export($data['membresias'], true).'</pre>';

        //$data['result'] = suma(3, 5);
        $data['version'] = $this->CI_VERSION;

        $data['title']='Módulo miembros';
        $data['main_content']='miembros/miembros_view';
        return view('includes/template', $data);
    }
    
    public function new($data = NULL){

        $paquetesModel = new PaquetesModel($db);
        $data['paquetes'] = $paquetesModel->find();

        $data['title']='Registrar nuevo miembro';
        $data['main_content']='miembros/frm_nuevo_miembro';
        return view('includes/template', $data);
    }

    public function insert($data = NULL){
        
        $membresiasModel = new MembresiasModel($db);
        $miembrosModel = new MiembrosModel($db);
        $paquetesModel = new PaquetesModel($db);
        $request = \Config\Services::request();

        $data = array(
            'nombre' => $request->getPostGet('nombre'),
            'cedula' => $request->getPostGet('cedula'),
            'telefono' => $request->getPostGet('telefono'),
            'email' => $request->getPostGet('email'),
            'idpaquete' => $request->getPostGet('idpaquete')
        );
        
//PABLO: Implementar las validaciones
        // if($miembrosModel->save($data) === false){
        //     var_dump($miembrosModel->errors());
        // }else{
            $miembrosModel->save($data);
            $idmiembros = $db->insertID();
            
            $paquete = $paquetesModel->find($data['idpaquete']);

            $fecha_inicio = date("Y-m-d"); 
            $fecha_final = date("Y-m-d",strtotime($fecha_inicio."+ ".$paquete->dias." days")); 

            $membresia = array(
                'idpaquete' => $data['idpaquete'],
                'idmiembros' => $idmiembros,
                'fecha_inicio' => date("Y-m-d"),
                'fecha_final' => $fecha_final,
                'saldo' => $paquete->entradas,
            );
            $membresiasModel->save($membresia);
            return redirect()->to('/');
        //}  
        
    }

    public function editar($id){
        $paquetesModel = new PaquetesModel($db);
        $data['paquetes'] = $paquetesModel->find();

        $data['title']='Editar nuevo miembro';
        $data['main_content']='miembros/frm_edit_miembro';
        return view('includes/template', $data);
    }
}
