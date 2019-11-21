<?php

class C_inicial extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model("m_mascotas");
    }
    
    public function index()
    {
        $this->load->view("v_cabecera");
        $this->load->view("v_inicio");
        $this->load->view("v_pie");
        $this->load->view("v_fin");
        
    }

    public function desconectarse(){
        $this->session->sess_destroy();
        redirect('c_inicial/index', 'refresh');
    }
    
    public function nueva_mascota(){
        $this->load->view("v_cabecera");
        
        
        $this->load->view("v_fin");
    }
}
