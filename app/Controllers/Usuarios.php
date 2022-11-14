<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Usuarios extends BaseController {

    public function index() {

        //$data['version'] = $this->CI_VERSION;

        $data['title']='Login';
        $data['main_content']='usuarios/login_view';
        return view('includes/template_login', $data);
    }

    public function validate_credentials(){
        $data = [
            'user' => $this->request->getPostGet('user'),
            'password' => $this->request->getPostGet('password')
        ];
        //echo '<pre>'.var_export($data, true).'</pre>';

        
        $this->validation->setRuleGroup('login');
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{
            $usuario = $this->usuarioModel->_getUsuario($data);

            if (isset($usuario) && $usuario != NULL) {
                //valido el login y pongo el id en sesion
                //echo '<pre>'.var_export($usuario, true).'</pre>';
                $sessiondata = [
                    'logged_in' => 1,
                    'idusuario' => $usuario->idusuarios,
                    'nombre' => $usuario->nombre,
                    'idrol' => $usuario->idroles,
                    'rol' => $usuario->rol,
                    'admin' => $usuario->admin,
                    'miembros' => $usuario->miembros,
                    'instructor' => $usuario->instructor
                ];

                $user = [
                    'logged' => 1
                ];
                
                $this->usuarioModel->update($usuario->idusuarios, $user);
                $this->session->set($sessiondata);

                return redirect()->to('inicio');
            }else{

                return redirect()->to('/');
            }
        }

    }

    public function inicio(){

        $data['idroles'] = $this->session->idroles;
        $data['idusuarios'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        
        if ($data['logged_in'] == 1) {

            //echo '<pre>'.var_export($data['idempresa'], true).'</pre>';
            //Permisos
            $data['nombre'] = $this->session->nombre;
            $data['instructor'] = $this->session->instructor;
            $data['miembros'] = $this->session->miembros;
            $data['admin'] = $this->session->admin;

            $data['version'] = $this->version;

            $data['title']='Inicio';
            $data['main_content']='home/inicio_view';
            return view('includes/template', $data);
            
            
        }else{
            $this->salir();
        }
    }

    public function salir(){
        //destruyo la session  y salgo
        $idusuario = $this->session->idusuario;
        $user = [
            'logged' => 0
        ];
        
        $this->usuarioModel->update($idusuario, $user);
        $this->session->destroy();
        return redirect()->to('/');
    }
    
}
