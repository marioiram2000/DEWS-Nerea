<?php

class C_prestamos extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model("m_prestamos");
        
    }
    
    public function index()
    {
        $datosCabecera['todosGeneros'] = $this->m_prestamos->todosGeneros();
        $this->load->view("v_cabecera", $datosCabecera);
        $this->load->view("v_pie");
    }
    
    public function clasificar($genero){
        $this->load->helper('form');
        $datos['todosGeneros'] = $this->m_prestamos->todosGeneros();
        $this->load->view("v_cabecera", $datos);
        
        $datos['genero'] = $genero;
        $libros = $this->m_prestamos->librosPorGenero($genero);
        $libros = $this->m_prestamos->codificarLibros($libros);
        $datos['libros'] = $libros;
       
        $this->load->view("v_librosXgenero", $datos);
        
        $this->load->view("v_pie");
    }
}