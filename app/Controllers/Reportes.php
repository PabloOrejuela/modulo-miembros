<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Libraries\PdfLibrary;

class Reportes extends BaseController{


    public function index(){
        
        $data['title']='Reportes';
        $data['main_content']='reportes/reportes_view';
        return view('includes/template', $data);
    }

    public function pruebaPDF(){
        $this->pdf = new PdfLibrary("L", "mm", "A4", true, 'UTF-8', false);
        $this->pdf->setPrintHeader(false);
        $this->pdf->setPrintFooter(false);
        //Información referente al PDF
        $this->pdf->SetCreator('PDF_CREATOR');
        $this->pdf->SetAuthor('Pablo Orejuela');
        $this->pdf->SetTitle('Lista de miembros activos');
        $this->pdf->SetSubject('Reportes GTK Admin');
        $this->pdf->SetKeywords('TCPDF, PDF, reportes');

        $this->pdf->SetFont('Helvetica', 'C', 10);
        $this->pdf->SetMargins(12, 12, 12, true);
        $this->pdf->SetFillColor(247,246,228);
        $this->pdf->SetLineWidth(0.01);
        $this->pdf->setCellPaddings(1, 1, 1, 1);
        $this->pdf->SetLineStyle(array('width' => 0.01, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(10, 0, 0)));

        // Saltos de página automáticos.
        $this->pdf->SetAutoPageBreak(TRUE, 20);


        // Establecer el ratio para las imagenes que se puedan utilizar
        //$this->pdf->setImageScale('PDF_IMAGE_SCALE_RATIO');

        // Establecer la fuente
        $this->pdf->SetFont('Helvetica', 'P', 11);
        $this->pdf->SetMargins(12, 12);

        // Añadir página
        $this->pdf->AddPage();

        $this->pdf->SetFont('helvetica', 'B', 12);
        $this->pdf->Cell(180, 0, 'Hola mundo', 'tbrl', 0, 'C', false);
        

        $this->pdf->ln(12);
        $this->pdf->SetFont('helvetica', 'B', 10);
        $this->pdf->Cell(18, 0, 'FECHA: ', '', 0, 'L', false);

        ob_end_clean();
        //Cerramos y damos salida al fichero PDF
        $this->pdf->Output('reporte.pdf', 'I');
    }
}

/**Endo of file**/