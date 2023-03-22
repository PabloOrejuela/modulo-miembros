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
                    'idusuario' => $usuario->idusuario,
                    'nombre' => $usuario->nombre,
                    'idrol' => $usuario->idrol,
                    'rol' => $usuario->rol,
                ];

                $user = [
                    'logged' => 1
                ];
                
                $this->usuarioModel->update($usuario->idusuario, $user);
                $this->session->set($sessiondata);

                return redirect()->to('inicio');
            }else{

                return redirect()->to('/');
            }
        }

    }

    public function inicio(){

        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {

            //echo '<pre>'.var_export($data['idempresa'], true).'</pre>';
            $data['version'] = $this->version;

            $data['title']='Inicio';
            $data['main_content']='home/inicio_view';
            return view('includes/template', $data);
            
            
        }else{
            $this->salir();
        }
    }

    public function showUsuarios($data = NULL){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {
            $data['usuarios'] = $this->usuarioModel->findAll();

            $data['title']='Lista de usuarios';
            $data['main_content']='usuarios/lista_usuarios';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function editar($idusuario){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {
            
            $data['roles'] = $this->rolModel->findAll();
            $data['usuario'] = $this->usuarioModel->find($idusuario);
            //$data['lastQuery'] = $this->db->getLastQuery();
            //echo '<pre>'.var_export($data['usuario'], true).'</pre>';exit;

            $data['title']='Editar Usuario';
            $data['main_content']='usuarios/frm_edit_usuario';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function update(){    
        
        $password = $this->request->getPostGet('password');

        if ($password != '') {
            $data = [
                'nombre' => $this->request->getPostGet('nombre'),
                'num_documento' => $this->request->getPostGet('num_documento'),
                'telefono' => $this->request->getPostGet('telefono'),
                'email' => $this->request->getPostGet('email'),
                'idrol' => $this->request->getPostGet('idrol'),
                'user' => $this->request->getPostGet('user'),
                'password' => md5($password)
            ];
        }else{
            $data = [
                'nombre' => $this->request->getPostGet('nombre'),
                'num_documento' => $this->request->getPostGet('num_documento'),
                'telefono' => $this->request->getPostGet('telefono'),
                'email' => $this->request->getPostGet('email'),
                'idrol' => $this->request->getPostGet('idrol'),
                'user' => $this->request->getPostGet('user'),
            ];
        }
        
        
        $this->validation->setRuleGroup('updateUser');
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{
            
            //echo '<pre>'.var_export($data, true).'</pre>';exit;
            
            $lastQuery = $this->miembrosModel->save($data);
            return redirect()->to('usuarios');
            
        }
    }

    public function nuevo($data = NULL){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {
            $data['roles'] = $this->rolModel->findAll();

            $data['title']='Registrar nuevo usuario';
            $data['main_content']='usuarios/frm_nuevo_usuario';
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
            'idrol' => $this->request->getPostGet('idrol'),
            'user' => $this->request->getPostGet('user'),
            'password' => md5($this->request->getPostGet('password'))
        );
        //echo '<pre>'.var_export($data, true).'</pre>';exit;
        $this->validation->setRuleGroup('newUser');
        
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{ 

            $this->usuarioModel->save($data);
            $idusuarios = $this->db->insertID();
            return redirect()->to('usuarios');
        }
        
    }

    public function get_user_cedula($cedula){
        
        //Insertar asistencia de la membresía en asistencia
        $data = [
            'num_documento' => $this->request->getPostGet('num_documento'),
        ];

        //echo '<pre>'.var_export($data, true).'</pre>';
        

        $nombre = $this->usuarioModel->_getNameUserCedula($cedula);
        //$this->membresiasModel->_update_status_all($data['membresias']);
        
        //return redirect()->to('exitoAsistencia');
        return $nombre;
    }

    function usuarios_select(){
        $cedula = $this->request->getPostGet('num_documento');
        $datos['nombre'] = $this->usuarioModel->_getNameUserCedula($cedula);
        //return $datos['nombre'];
        return view('usuarios/input_usuario',$datos);
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
