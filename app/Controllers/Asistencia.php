<?php

namespace App\Controllers;

class Asistencia extends BaseController{

    
    /**
     * undocumented function summary
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function insert(){
        
        //Insertar asistencia de la membresía en asistencia
        $data = [
            'idmembresias' => $this->request->getPostGet('idmembresias'),
            'num_asistencias' => $this->request->getPostGet('num_asistencias')
        ];

        //echo '<pre>'.var_export($data, true).'</pre>';
        

        $this->asistenciaModel->_insert_asistencia($data);
        
        return redirect()->to('/membresias');
    }

    public function FrmRegistraAsistenciaInstructor(){

        $data['idroles'] = $this->session->idroles;
        $data['idusuarios'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        
        if ($data['logged_in'] == 1) {

            $data['nombre'] = $this->session->nombre;
            $data['instructor'] = $this->session->instructor;
            $data['miembros'] = $this->session->miembros;
            $data['admin'] = $this->session->admin;

            $data['title']='Registra asistencia Instructor';
            $data['main_content']='asistencias/registra_asistencia_instructor_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }

    }

    public function registraAsistenciaInstructor(){
        $data = [
            'idusuario' => $this->request->getPostGet('idusuarios'),
            'cedula' => $this->request->getPostGet('cedula'),
            'fechaClase' => date('Y-m-d H:m:s'),
            'observaciones' => $this->request->getPostGet('observaciones')
        ];

        $this->validation->setRuleGroup('asistenciaInstructor');
        
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{ 
            $resp = $this->asistenciaInstructorModel->save($data);
            if ($resp) {

                $data['nombre'] = $this->session->nombre;
                $data['instructor'] = $this->session->instructor;
                $data['miembros'] = $this->session->miembros;
                $data['admin'] = $this->session->admin;

                $data['title']='Registro exitoso';
                $data['main_content']='asistencias/exito_asistencia_view';
                return view('includes/template', $data);
            }

            return redirect()->to('/');
        }     
    }


}
