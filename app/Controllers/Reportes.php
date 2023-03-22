<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use TCPDF;

class Reportes extends BaseController{


    public function index(){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {

            $data['title']='Reportes';
            $data['main_content']='reportes/reportes_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function lista_movimientos(){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {

            $data['movimientos'] = $this->movimientoModel->_get_all_movements();

            $data['title']='Reportes - Movimientos';
            $data['main_content']='reportes/lista_movimientos_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function frm_selecciona_instructor(){
        $data['idrol'] = $this->session->idrol;
        $data['idusuario'] = $this->session->idusuario;
        $data['logged_in'] = $this->session->logged_in;
        $data['nombre'] = $this->session->nombre;
        $data['permisos'] = $this->rolModel->find($data['idrol']);
        
        if ($data['logged_in'] == 1) {


            $data['instructores'] = $this->usuarioModel->_getUsuarioInstructor();
            //echo '<pre>'.var_export($data['instructores'], true).'</pre>';exit;
            $data['title']='Reportes - Asistencia instructor';
            $data['main_content']='usuarios/lista_instructores_view';
            return view('includes/template', $data);
        }else{
            return redirect()->to('salir');
        }
    }

    public function genera_reporte_asistencia_instructor(){

        $data = [
            'idusuarios' => $this->request->getPostGet('idusuarios'),
            'fecha_desde' => $this->request->getPostGet('fecha_desde'),
            'fecha_hasta' => $this->request->getPostGet('fecha_hasta'),
        ];
        //echo '<pre>'.var_export($publicDir, true).'</pre>';exit;
        $this->validation->setRuleGroup('ReporteAsistenciaInstructores');
        
        if (!$this->validation->withRequest($this->request)->run()) {
            //Depuración
            //dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }else{ 
            $this->ReporteAsistenciaInstructorPDF($data); 
            //return redirect()->to('reportes/selecciona-instructor'); 
        }
    }

    public function listaMiembrosPDF(){

        $miembros = $this->miembrosModel->_getMiembros();
        //echo '<pre>'.var_export($publicDir, true).'</pre>';exit;
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        $this->response->setHeader('Content-Type', 'application/pdf'); 
        $pdf->SetMargins(15, 10, 15); 
        $pdf->SetLineWidth(0.01);
        $pdf->setCellPaddings(0.8, 0.8, 0.8, 0.8);
        $pdf->SetFillColor(0,200,250);
        
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage(); 
        $html = '<img src="'.site_url().'public/images/logo-youshop.jpg" alt="You-logo" id="logo-report"  width="75" />';
        //$pdf->image(PDF_HEADER_LOGO, 15, 12, 20, 15, 'jpg', $link = '', $align = '', false, 50, '', false, false, 1, false, false, false);
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->ln(0);
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(190, 0, 'LISTA DE MIEMBROS ', '', 0, 'C', false);
        
        $pdf->ln(15);
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->Cell(7, 0, '#', 'TLRB', 0, 'L', true);
        $pdf->Cell(55, 0, 'Nombre', 'TLRB', 0, 'L', true);
        $pdf->Cell(30, 0, 'Cédula', 'TLRB', 0, 'L', true);
        $pdf->Cell(30, 0, 'Teléfono', 'TLRB', 0, 'L', true);
        $pdf->Cell(60, 0, 'Email', 'TLRB', 0, 'L', true);

        $n=1;
        foreach ($miembros as $value) {
            $pdf->ln();
            $pdf->SetFont('helvetica', 'P', 9);
            $pdf->Cell(7, 0, $n, 'TLRB', 0, 'L', false);
            $pdf->Cell(55, 0, $value->nombre, 'TLRB', 0, 'L', false);
            $pdf->Cell(30, 0, $value->num_documento, 'TLRB', 0, 'L', false);
            $pdf->Cell(30, 0, $value->telefono, 'TLRB', 0, 'L', false);
            $pdf->Cell(60, 0, $value->email, 'TLRB', 0, 'L', false);
            $n++;
        }
        //$pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('reporte-lista-miembros.pdf', 'I'); 
        //exit();
    }

    public function ReporteAsistenciaInstructorPDF($data){

        $asistencias = $this->asistenciaInstructorModel->_getAsistenciasInstructor($data['idusuarios']);
        $instructor = $this->usuarioModel->find($data['idusuarios']);
        //echo '<pre>'.var_export($instructor, true).'</pre>';exit;
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        $this->response->setHeader('Content-Type', 'application/pdf'); 
        $pdf->SetMargins(15, 10, 15); 
        $pdf->SetLineWidth(0.01);
        $pdf->setCellPaddings(0.8, 0.8, 0.8, 0.8);
        $pdf->SetFillColor(0,200,250);
        
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage(); 
        $html = '<img src="'.site_url().'public/images/logo-youshop.jpg" alt="You-logo" id="logo-report"  width="75" />';
        //$pdf->image(PDF_HEADER_LOGO, 15, 12, 20, 15, 'jpg', $link = '', $align = '', false, 50, '', false, false, 1, false, false, false);
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->ln(0);
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(190, 0, 'Clases impartidas por el instructor:  '.$instructor->nombre , '', 0, 'C', false);
        $pdf->Cell(190, 0, 'DESDE:  '.$data['fecha_desde'] , '', 0, 'C', false);
        $pdf->Cell(190, 0, 'HASTA:  '.$data['fecha_hasta'] , '', 0, 'C', false);
        
        $pdf->ln(15);
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->Cell(7, 0, '#', 'TLRB', 0, 'L', true);
        $pdf->Cell(40, 0, 'Fecha clase', 'TLRB', 0, 'L', true);
        $pdf->Cell(130, 0, 'Observaciones', 'TLRB', 0, 'L', true);

        $n=1;
        if ($asistencias != null) {
            foreach ($asistencias as $value) {
                $pdf->ln();
                $pdf->SetFont('helvetica', 'P', 9);
                $pdf->Cell(7, 0, $n, 'TLRB', 0, 'L', false);
                $pdf->Cell(40, 0, $value->fechaClase, 'TLRB', 0, 'L', false);
                $pdf->Cell(130, 0, $value->observaciones, 'TLRB', 0, 'L', false);
                $n++;
            }
        }else{
            $pdf->ln();
            $pdf->SetFont('helvetica', 'B', 9);
            $pdf->Cell(177, 0, 'NO HAY AISTENCIAS REGISTRADAS PARA ESTE INSTRUCTOR EN ESTE LAPSO DE TIEMPO', 'TLRB', 0, 'L', FALSE);
        }
        
        //$pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('reporte-lista-miembros.pdf', 'I'); 
        //exit();
    }

    public function listaMembresiasPDF(){

        $membresias = $this->membresiasModel->_getMembresias();
        
        //echo '<pre>'.var_export($publicDir, true).'</pre>';exit;
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        $this->response->setHeader('Content-Type', 'application/pdf'); 
        $pdf->SetMargins(15, 10, 15); 
        $pdf->SetLineWidth(0.01);
        $pdf->setCellPaddings(0.8, 0.8, 0.8, 0.8);
        $pdf->SetFillColor(0,200,250);
        
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage(); 
        $html = '<img src="'.site_url().'public/images/logo-youshop.jpg" alt="You-logo" id="logo-report"  width="75" />';
        //$pdf->image(PDF_HEADER_LOGO, 15, 12, 20, 15, 'jpg', $link = '', $align = '', false, 50, '', false, false, 1, false, false, false);
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->ln(0);
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(190, 0, 'MEMBRESIAS', '', 0, 'C', false);
        $pdf->ln(15);

        //CABECERAS
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->Cell(5, 0, '#', 'TLRB', 0, 'L', true);
        $pdf->Cell(45, 0, 'Nombre', 'TRB', 0, 'L', true);
        $pdf->Cell(25, 0, 'Cédula', 'TRB', 0, 'L', true);
        $pdf->Cell(20, 0, 'Fecha inicio', 'TRB', 0, 'L', true);
        $pdf->Cell(20, 0, 'Fecha final', 'TRB', 0, 'L', true);
        $pdf->Cell(10, 0, 'A', 'TRB', 0, 'C', true);
        $pdf->Cell(35, 0, 'Paquete', 'TRB', 0, 'L', true);
        $pdf->Cell(23, 0, 'Estado', 'TRB', 0, 'C', true);

        $n=1;

        foreach ($membresias as $value) {
            $pdf->ln();
            $pdf->SetFont('helvetica', 'P', 9);
            $pdf->Cell(5, 0, $n, 'TLRB', 0, 'L', false);
            $pdf->Cell(45, 0, $value->nombre, 'TRB', 0, 'L', false);
            $pdf->Cell(25, 0, $value->num_documento, 'TRB', 0, 'L', false);
            $pdf->Cell(20, 0, $value->fecha_inicio, 'TRB', 0, 'L', false);
            $pdf->Cell(20, 0, $value->fecha_final, 'TRB', 0, 'L', false);
            $pdf->Cell(10, 0, $value->asistencias, 'TRB', 0, 'C', false);
            $pdf->Cell(35, 0, $value->paquete, 'TRB', 0, 'L', false);
            if ($value->status == 1) {
                $pdf->Cell(23, 0, 'ACTIVA', 'TRB', 0, 'C', false);
            }else{
                $pdf->Cell(23, 0, 'CADUCADA', 'TRB', 0, 'C', false);
            }
            
            $n++;
        }
        //$pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('reporte-lista-memebresias.pdf', 'I'); 
        //exit();
    }
}

/**Endo of file**/