<?php

namespace App\Controllers;
use App\Models\MembresiasModel;
use App\Models\MiembrosModel;
use App\Models\PaquetesModel;

class Membresia extends BaseController{

    public function index(){

        $membresiasModel = new MembresiasModel($db);

        $miembrosModel = new MiembrosModel($db);
        $data['membresias'] = $membresiasModel->_getMembresias();

        
        //echo '<pre>'.var_export($data['membresias'], true).'</pre>';

        
        //$data['version'] = $this->CI_VERSION;

        $data['title']='Registro de membresías';
        $data['main_content']='membresias/membresias_view';
        return view('includes/template', $data);
    }

    public function edit($id){
        echo "Edita membresia";
    }


}
