<?php

namespace App\Controllers;

class Paquetes extends BaseController{


    public function getPaquete($idpaquetes){

        $data['paquete'] = $this->paquetesModel->find($idpaquetes);
        //echo '<pre>'.var_export($data['miembros'], true).'</pre>';

        return $data;
    }

}
