<?php

namespace App\Controllers;

class Membresia extends BaseController{

    public function index(){

        $data['membresias'] = $this->membresiasModel->_getMembresias();
        $this->membresiasModel->_update_status_all($data['membresias']);

        
        //echo '<pre>'.var_export($data['membresias'], true).'</pre>';

        
        //$data['version'] = $this->CI_VERSION;

        $data['title']='Registro de membresías';
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


}
