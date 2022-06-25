<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use TCPDF;

class Reportes extends BaseController{


    public function index(){
        
        $data['title']='Reportes';
        $data['main_content']='reportes/reportes_view';
        return view('includes/template', $data);
    }

    public function listaMiembrosPDF(){
       
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 
        $this->response->setHeader('Content-Type', 'application/pdf');                // create TCPDF object with default constructor args
        $pdf->AddPage();                    // pretty self-explanatory
        $pdf->Write(1, 'Hola Nadia guapita');      // 1 is line height
        $pdf->Output('hello_world.pdf', 'I');    // send the file inline to the browser (default).
        //exit();
        
    }
}

/**Endo of file**/