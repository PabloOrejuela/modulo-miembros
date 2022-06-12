<?php

namespace App\Controllers;

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

        $data = [
            'idmembresias' => $idmembresias,
        ];

        $this->asistenciaModel->save($data);

        //actualizar Disponible en membresia
        $asistencias = $this->asistenciaModel->_get_all_attend($idmembresias); 
        //echo '<pre>'.var_export(count($asistencias), true).'</pre>';

        //Actualizo las asistencias de esa membresía
        $data = array(
            'idmembresias' => $idmembresias,
            'asistencias' => count($asistencias)
        );
        $this->membresiasModel->save($data);
        
        return redirect()->to('/membresias');
    
    }


}
