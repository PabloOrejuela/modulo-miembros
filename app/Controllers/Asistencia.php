<?php

namespace App\Controllers;
use App\Models\AsistenciaModel;

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
        
        return redirect()->to('/');
    
    }


}
