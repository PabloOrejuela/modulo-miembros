<?php

namespace App\Controllers;
use App\Models\AsistenciaModel;
use App\Models\MembresiasModel;

class Asistencia extends BaseController{

    
    /**
     * undocumented function summary
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function insert($idmembresias){
        

        //Insertar asistencia de la membresía en asistencia
        $asistenciaModel = new AsistenciaModel;

        $data = [
            'idmembresias' => $idmembresias,
        ];

        $asistenciaModel->save($data);

        //actualizar Disponible en membresia
        $asistencias = $asistenciaModel->_get_all_attend($idmembresias); 
        //echo '<pre>'.var_export(count($asistencias), true).'</pre>';

        //Actualizo las asistencias de esa membresía
        $membresiasModel = new MembresiasModel($db);
        $data = array(
            'idmembresias' => $idmembresias,
            'asistencias' => count($asistencias)
        );
        $membresiasModel->save($data);
        
        return redirect()->to('/membresias');
    
    }


}
