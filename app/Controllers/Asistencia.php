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
    public function insert(){
        
        //Insertar asistencia de la membresía en asistencia
        $data = [
            'idmembresias' => $this->request->getPostGet('idmembresias'),
            'num_asistencias' => $this->request->getPostGet('num_asistencias')
        ];

        echo '<pre>'.var_export($data, true).'</pre>';
        

        $this->asistenciaModel->_insert_asistencia($data);
        
        return redirect()->to('/membresias');
    }


}
