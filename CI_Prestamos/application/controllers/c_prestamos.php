<?php

class c_prestamos extends CI_Controller{
    function __construct() {
        parent::__construct();
        
    }
    
    public function index()
    {
        $this->load->view("v_cabecera");
        
        $this->load->view("v_pie");
    }
}