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
        $datos['todosGeneros'] = $this->m_prestamos->todosGeneros();
        $this->load->view("v_cabecera", $datos);
        
        $datos['genero'] = $genero;
        $libros = $this->m_prestamos->librosPorGenero($genero);
        $libros = $this->m_prestamos->codificarLibros($libros);
        $datos['libros'] = $libros;
       
        $this->load->view("v_librosXgenero", $datos);
        
        $this->load->view("v_pie");
    }
    
    public function prestar($genero){
        $datos['todosGeneros'] = $this->m_prestamos->todosGeneros();
        $this->load->view("v_cabecera", $datos);
        
        $datos['genero'] = $genero;
        $libros = $this->m_prestamos->librosPorGenero($genero);
        $libros = $this->m_prestamos->codificarLibros($libros);
        $datos['libros'] = $libros;
        
        $libros_seleccionados = $this->input->post('seleccionado');//Array ( [0] => 8 [1] => 9 [2] => 11 [3] => 12 )
        $libros = $this->m_prestamos->recorrerPrestamos($libros_seleccionados);
        $datos['titulos']=$libros;
        
        $this->load->view("v_librosXgenero", $datos);
        
        $this->load->view("v_pie");
        
    }
}