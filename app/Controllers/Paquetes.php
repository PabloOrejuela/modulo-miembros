<?php

namespace App\Controllers;
use App\Models\PaquetesModel;

class Paquetes extends BaseController{


    public function getPaquete($idpaquetes){

        $paquetesModel = new PaquetesModel($db);
        $data['paquete'] = $paquetesModel->find($idpaquetes);
        //echo '<pre>'.var_export($data['miembros'], true).'</pre>';

        return $data;
    }

}
