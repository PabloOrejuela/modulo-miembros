<?php

namespace App\Controllers;

class Miembros extends BaseController{


    public function index(){

        $data['miembros'] = $this->miembrosModel->_getMiembros();
        
        //echo '<pre>'.var_export($data['membresias'], true).'</pre>';
        //$data['result'] = suma(3, 5);
        $data['version'] = $this->CI_VERSION;

        $data['title']='Lista de miembros';
        $data['main_content']='miembros/miembros_view';
        return view('includes/template', $data);
    }
    
    public function nuevo($data = NULL){

        $data['paquetes'] = $this->paquetesModel->find();

        $data['title']='Registrar nuevo miembro';
        $data['main_content']='miembros/frm_nuevo_miembro';
        return view('includes/template', $data);
    }

    public function insert($data = NULL){

        $data = array(
            'nombre' => $this->request->getPostGet('nombre'),
            'cedula' => $this->request->getPostGet('cedula'),
            'telefono' => $this->request->getPostGet('telefono'),
            'email' => $this->request->getPostGet('email'),
            'idpaquete' => $this->request->getPostGet('idpaquete')
        );
        
        $this->validation->setRules([
            'nombre'     => 'required|min_length[5]',
            'email'        => 'required|valid_email|is_unique[miembros.email]',
            'cedula'        => 'required|is_unique[miembros.cedula]',
            'telefono'        => 'required',
        ]);
        
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{
    
            $paquete = $this->paquetesModel->find($data['idpaquete']);
    
            //echo '<pre>Hola'.var_export($paquete->entradas, true).'</pre>';
            $fecha_inicio = date("Y-m-d"); 
            $fecha_final = date("Y-m-d",strtotime($fecha_inicio."+ ".$paquete->dias." days")); 

            $this->miembrosModel->save($data);
            $idmiembros = $this->db->insertID();

            //PABLO Si elige paquete se inserta la membresía
            $membresia = array(
                'idpaquete' => $data['idpaquete'],
                'idmiembros' => $idmiembros,
                'fecha_inicio' => date("Y-m-d"),
                'fecha_final' => $fecha_final,
                'asistencias' => 0,
                'total' => $paquete->entradas,
                'status' => 1
            );
            $this->membresiasModel->save($membresia);
            return redirect()->to('/');
        }  
        
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
        $validation = service('validation');
        $validation->setRules([
            'nombre'     => 'required|min_length[5]',
            'email'        => 'required|valid_email',
            'cedula'        => 'required',
            'telefono'        => 'required',
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
            ];
            //echo '<pre>'.var_export($data, true).'</pre>';
            $lastQuery = $this->miembrosModel->save($data);
            
            return redirect()->to('/');
        }
    }

}
