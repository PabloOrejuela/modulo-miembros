<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;

class Membresia extends BaseController{

    public function index(){

        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {

            $data['membresias'] = $this->membresiasModel->_getMembresias();

            //Actualizo el status de las membresías

            $this->membresiasModel->_update_status_all($data['membresias']);
            $this->membresiasModel->_update_cantidad_usos_membresia($data['membresias']);
            
            $data['membresias'] = $this->membresiasModel->_getMembresias();
            //echo '<pre>'.var_export($data['membresias'], true).'</pre>';
            //$data['version'] = $this->version;

            $data['title']='Lista de membresías';
            $data['main_content']='membresias/membresias_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function edit($idmembresias){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {
            $data['membresia'] = $this->membresiasModel->_getMembresia($idmembresias);
            //echo '<pre>'.var_export($data['membresia'], true).'</pre>';

            $data['title']='Edición de membresías';
            $data['main_content']='membresias/frm_edit_membresias_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    /**
     * Actualiza la fecha final de una membresía
     */

     public function update_date(){
        
        $data = [
            'fecha_final' => $this->request->getPostGet('fecha_final'),
            'idmembresias' => $this->request->getPostGet('idmembresias'),
            'idmiembros' => $this->request->getPostGet('idmiembros'),
            'observacion' => $this->request->getPostGet('observacion'),
            'idtipomovimiento' => $this->request->getPostGet('idtipomovimiento'),
            'idusuarios' => $this->session->idusuario
        ];

        //$fecha_inicio = Time::parse($data['fecha_inicio']);
        $fecha_final  = Time::parse($data['fecha_final']);

        //$diff = $fecha_inicio->difference($fecha_final);
        //$data['total']= date("Y-m-d",strtotime($fecha_inicio."+ ".$paquete->dias." days")); 
        
        //echo '<pre>'.var_export($data['total'], true).'</pre>';
        $lastQuery = $this->membresiasModel->_update_fecha_final_membresia($data);
        
        return redirect()->to('membresias');
        
     }

     /**
      * Form para seleccionar la membresía que se desea transferir
      */
     public function frm_select_transfer(){

        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {

            $data['membresias'] = $this->membresiasModel->_getMembresias();
            $this->membresiasModel->_update_status_all($data['membresias']);

            //echo '<pre>'.var_export($data['membresias'], true).'</pre>';

            $data['title']='Tranferir membresías';
            $data['main_content']='membresias/frm_transfer_membresias_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
     }

     /**
      * Frm para selecccionar el miembro al que se le desea transferir la membresía
      */
      public function fr_select_member_transfer_membership($idmembresias){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {
            
            $data['membresia'] = $this->membresiasModel->_getMembresia($idmembresias);
            $data['miembrosList'] = $this->miembrosModel->_getMiembros();
            //echo '<pre>'.var_export($data['miembros'], true).'</pre>';

            $data['title']='Transferir membresía';
            $data['main_content']='membresias/frm_transfiere_membresia';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
        
     }

     /**
      * Transfiere le membresía al usuario
      */
      public function transfer_membership(){

        
        $data = [
            'idmembresias' => $this->request->getPostGet('idmembresias'),
            'idmiembros' => $this->request->getPostGet('idmiembros'),
            'observacion' => $this->request->getPostGet('observacion'),
            'idtipomovimiento' => 1, //TRANSFERENCIA
            'idusuario' => $this->session->idusuario
        ];
        $this->validation->setRuleGroup('transfiere_membresia');
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{
            //echo '<pre>'.var_export($data, true).'</pre>';exit;
            //LLamo a la funcion del modelo que transfiere la membresía
            $result = $this->membresiasModel->_transfiere_membresia($data);
            if ($result == NULL) {
                //echo $lastQuery;
            }else{
                return redirect()->to('membresias');
            }
        }
    }

    public function frm_asigna_membresia_miembro(){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {
            
            $data['miembrosList'] = $this->miembrosModel->_getMiembros();
            //$data['lastQuery'] = $this->db->getLastQuery();

            $data['title']='Asignar una membresía a un miembro';
            $data['main_content']='membresias/frm_asigna_membresia_miembro';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function asigna_membresia_miembro($idmiembros){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {
            
            $data['paquetes'] = $this->paquetesModel->find();
            $data['datos'] = $this->miembrosModel->find($idmiembros);
            //$data['lastQuery'] = $this->db->getLastQuery();

            $data['title']='Asignar una membresía a un miembro';
            $data['main_content']='membresias/asigna_membresia_miembro';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function asign_membresia(){        

        $data = [
            'idpaquete' => $this->request->getPostGet('idpaquete'),
            'idmiembros' => $this->request->getPostGet('idmiembros'),
            'observacion' => $this->request->getPostGet('observacion'),
        ];
        $this->validation->setRuleGroup('asigna_membresia');
        
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{
       
            //object
            $paquete = $this->paquetesModel->find($data['idpaquete']);

            if ($data['idpaquete'] != 0 && $data['idpaquete'] != '0') {
                $fecha_inicio = date("Y-m-d"); 
                if($paquete->idcategoria == 3){

                }
                $fecha_final = date("Y-m-d",strtotime($fecha_inicio."+ ".$paquete->dias." days"));
                $membresia = array(
                    'idpaquete' => $data['idpaquete'],
                    'idmiembros' => $data['idmiembros'],
                    'fecha_inicio' => date("Y-m-d"),
                    'fecha_final' => $fecha_final,
                    'asistencias' => $paquete->entradas,    
                    'status' => 1
                );
                //echo '<pre>'.var_export($data, true).'</pre>';
                $this->membresiasModel->save($membresia);
                $idmembresias = $this->db->insertID();
                //echo '<pre>'.var_export($data, true).'</pre>';
                if ($idmembresias) {
                    $movimiento = [
                        'idmembresias' => $idmembresias,
                        'idmiembros' => $this->request->getPostGet('idmiembros'),
                        'observacion' => $this->request->getPostGet('observacion'),
                        'idtipomovimiento' => 1, //TRANSFERENCIA
                        'idusuarios' => $this->session->idusuario
                    ];

                    $this->movimientoModel->_insert_movimiento($movimiento);
                }
            }
            return redirect()->to('membresias');
        }
    }
     
}
