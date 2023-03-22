<?php

namespace App\Controllers;

class Miembros extends BaseController{


    public function index(){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {
            $data['miembrosList'] = $this->miembrosModel->_getMiembros();
            
            //echo '<pre>'.var_export($data['membresias'], true).'</pre>';
            //$data['result'] = suma(3, 5);
            $data['version'] = $this->CI_VERSION;

            $data['title']='Lista de miembros';
            $data['main_content']='miembros/miembros_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }
    
    public function nuevo($data = NULL){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {
            $data['paquetes'] = $this->paquetesModel->find();

            $data['title']='Registrar nuevo miembro';
            $data['main_content']='miembros/frm_nuevo_miembro';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function insert($data = NULL){

        $data = array(
            'nombre' => $this->request->getPostGet('nombre'),
            'num_documento' => $this->request->getPostGet('num_documento'),
            'telefono' => $this->request->getPostGet('telefono'),
            'email' => $this->request->getPostGet('email'),
            'idpaquete' => $this->request->getPostGet('idpaquete'),
            'fecha_nacimiento' => $this->request->getPostGet('fecha_nacimiento')
        );
        
        $this->validation->setRuleGroup('newMember');
        
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{ 

            $this->miembrosModel->save($data);
            $idmiembros = $this->db->insertID();
            
            if ($data['idpaquete'] != 0 && $data['idpaquete'] != '0') {

                $paquete = $this->paquetesModel->find($data['idpaquete']);
                $fecha_inicio = date("Y-m-d"); 
                $fecha_final = date("Y-m-d",strtotime($fecha_inicio."+ ".$paquete->dias." days"));
                
                $membresia = array(
                    'idpaquete' => $data['idpaquete'],
                    'idmiembros' => $idmiembros,
                    'fecha_inicio' => date("Y-m-d"),
                    'fecha_final' => $fecha_final,
                    'asistencias' => 0,
                    'status' => 1
                );
                $this->membresiasModel->save($membresia);
            }
            return redirect()->to('miembros');
        }  
        
    }

    

    public function editar($idmiembros){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {
            
            $data['paquetes'] = $this->paquetesModel->find();
            $data['datos'] = $this->miembrosModel->find($idmiembros);
            //$data['lastQuery'] = $this->db->getLastQuery();

            $data['title']='Editar miembro';
            $data['main_content']='miembros/frm_edit_miembro';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function update(){        
        $validation = service('validation');
        $validation->setRules([
            'nombre'     => 'required|min_length[5]',
            'email'        => 'required|valid_email',
            'cedula'        => 'required',
            'telefono'        => 'required',
            'fecha_nacimiento' => 'required|valid_date'
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }else{
            $data = [
                'idmiembros' => $this->request->getPostGet('idmiembros'),
                'nombre' => $this->request->getPostGet('nombre'),
                'cedula' => $this->request->getPostGet('cedula'),
                'telefono' => $this->request->getPostGet('telefono'),
                'email' => $this->request->getPostGet('email'),
                'fecha_nacimiento' => $this->request->getPostGet('fecha_nacimiento')
            ];
            //echo '<pre>'.var_export($data, true).'</pre>';
            $lastQuery = $this->miembrosModel->save($data);
            return redirect()->to('miembros');
            
        }
    }

}
