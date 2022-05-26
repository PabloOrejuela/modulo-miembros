<?php
    echo view('includes/header')
        .view('includes/header2')
        .view('includes/botonera')
        .view($main_content)
        .view('includes/footer');
    //$this->load->view('includes/footer');
