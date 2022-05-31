<?php

namespace App\Controllers;
use App\Models\MembresiasModel;

class Membresia extends BaseController{

    public function index(){

        $membresiasModel = new MembresiasModel($db);

        
        //echo '<pre>'.var_export($data['miembros'], true).'</pre>';

        $data['result'] = suma(3, 5);
        $data['version'] = $this->CI_VERSION;
        $data['titulo'] = $this->session->get('titulo');

        $data['title']='Módulo miembros';
        $data['main_content']='membresias/membresias_view';
        return view('includes/template', $data);
    }

}
