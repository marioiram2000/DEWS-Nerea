<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_autores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("m_libros");
    }
    
    public function index($mens=null){
        //$mens es un mensaje que se v a apasar a la vista v_altaautor        
        
        $datosTitulobiblio['titulo']="BIBLIOTECA AGORA";
        $datosTitulobiblio['cantAutores']=$this->m_libros->cantAutores();
        $datosTitulobiblio['cantLibros']=$this->m_libros->cuantosLibros();
        
        $datosAutores['autores']=$this->m_libros->getAutores();
        
        $datosAltaAutor['mens_insercion']=$mens;
        $this->load->view("v_titulobiblio", $datosTitulobiblio);
        $this->load->view("v_autores", $datosAutores);
        $this->load->view("v_altaautor", $datosAltaAutor);
                
        $this->load->view("v_pie");
    }
    
    public function alta() {        
        //Viene desde el submit de altaautor
        if(!isset($_POST['submitalta'])){
            $this->index();
        }else{
            $nombre = $_POST['nombre'];
            $fechanac = $_POST['fechanac'];
            $nacionalidad = $_POST['nacionalidad'];
            $insertok=$this->m_libros->insertAutor($nombre, $fechanac, $nacionalidad);
            if($insertok){
                $this->index(true);
            }else{
                $this->index(false);
            }
        }
    }
    
    public function librosAutor($idAutor){
        $datosTitulobiblio['titulo']="BIBLIOTECA AGORA";
        $datosTitulobiblio['autor']=$this->m_libros->getAutor($idAutor);
        
        $datosLibrosAutor['libros']=$this->m_libros->getLibrosAutor($idAutor);
                
        $this->load->view("v_titulobiblio", $datosTitulobiblio);
        $this->load->view("v_librosAutor", $datosLibrosAutor);
        $this->load->view("v_pie");
    }
}
