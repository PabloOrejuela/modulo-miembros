<?php

namespace App\Controllers;

class Paquetes extends BaseController{

    protected $tipo_paquete = [
        '1' => 'normal',
        '2' => 'multipase'
    ];


    public function getPaquete($idpaquetes){

        $data['paquete'] = $this->paquetesModel->find($idpaquetes);
        //echo '<pre>'.var_export($data['miembros'], true).'</pre>';

        return $data;
    }

}
