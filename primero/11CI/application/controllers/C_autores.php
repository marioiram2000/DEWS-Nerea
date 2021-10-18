<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_autores extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->model("m_autores");
        }
	public function index()
	{
                $this->load->model("m_autores");
                $datos['frase']="AUTORES";
                $this->load->view("v_cabecera", $datos);
                
                $datos['autores']= $this->m_autores->autores();
                $this->load->view("v_autores");
                
                $this->load->view("v_pie");
	}
        public function verautor($idautor){
                $autor = $this->m_autores->autor($idautor);
                $datos['frase']=$autor->nombre."(".$autor->nacionalidad.")";
                $this->load->view("v_cabecera", $datos);
                
        }
        
        public function autor($idautor){
            
        }
}
