<?php

namespace App\Controllers;
use App\Models\MiembrosModel;

class Miembros extends BaseController{

    public function index(){

        $miembrosModel = new MiembrosModel($db);

        $data['miembros'] = $miembrosModel->find('1');
        //echo '<pre>'.var_export($data['miembros'], true).'</pre>';

        $data['result'] = suma(3, 5);
        $data['version'] = $this->CI_VERSION;

        $data['title']='Módulo miembros';
        $data['main_content']='miembros/miembros_view';
        return view('includes/template', $data);
    }
    
    public function nuevo($data = NULL){
        $data['title']='Módulo miembros';
        $data['main_content']='miembros/frm_nuevo_miembro';
        return view('includes/template', $data);
    }

}
