<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_devoluciones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("m_libros");
    }
    
    public function index(){       
        $this->load->view("v_cabecera");
        $this->load->view("v_login");
        $this->load->view("v_pie");
        
    }
    
    public function login() {
        if(!isset($_POST['submitlogin'])){
            $this->index();
        }else{
            $dni=$_POST['dni'];
            $pas=$_POST['pass'];
            
            $empleado = $this->m_libros->login($dni,$pas);
            if($empleado==null){
                $this->session->set_flashdata('error', 'Login erroneo');
            }else{
                $this->session->set_userdata('empleado', $empleado);
                $this->prestamos();
            }
        }
    }
    
    public function prestamos(){        
        if(! $this->session->userdata('idsprestamos')){
            $this->session->set_userdata('idsprestamos', array());
        }
        
        $datos['prestamos'] = $this->m_libros->getPrestamos();
        
        
        $this->load->view("v_cabecera");
        $this->load->view("v_prestamos", $datos);
        $this->load->view("v_pie");
    }
    
    public function anotarDevolucion($idprestamo){
        $ids=$this->session->userdata('idsprestamos');
        if(!in_array($idprestamo, $ids)){
            $ids[]=$idprestamo;
        }
        $this->session->set_userdata('idsprestamos', $ids);
        
        $this->prestamos();
    }
    
    public function grabarDevoluciones(){
        $devueltos=$this->m_libros->devolverPrestamos($this->session->userdata('idsprestamos'));
        $this->session->set_flashdata('rtdodevolucion', "$devueltos prestamos devueltos");
        $this->session->unset_userdata('idsprestamos');
        $this->prestamos();
    }
}
