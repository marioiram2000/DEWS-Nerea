<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_Listado extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("m_libros");
    }
    
    public function index(){
            $this->load->view("v_cabecera");
            $this->cargarVistaLibros();
            $this->load->view("v_pie");
	}
        
        public function cargarVistaLibros() {            
            $datos['cantLibros'] = $this->m_libros->cuantosLibros();
            $datos['libros'] = $this->m_libros->getLibros();
            
            $this->load->view("v_listaLibros", $datos);
        }
        
        public function verLibro($idLibro) {
            
            $this->load->view("v_cabecera");
            $this->cargarVistaLibros();
            $this->cargarLibro();
            $this->load->view("v_pie");
        }
        
        public function cargarVistaLibro($idLibro) {
            $datos['libro'] = $this->m_libros->getLibro($idLibro);
            $datos['fechas']= $this->m_libros->prestamos($idLibro);
            
            $this->load->view("v_libro");
        }
}