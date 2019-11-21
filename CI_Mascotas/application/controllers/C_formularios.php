<?php

class C_formularios extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model("m_mascotas");
    }
    
    public function registro(){
        $this->load->view("v_cabecera");
        
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('correo', 'Correo', 'required|is_unique[usuarios.correo]');
        $this->form_validation->set_rules('username', 'Nombre de usuario', 'required|is_unique[usuarios.username]');
        $this->form_validation->set_rules('psw1', 'Password', 'required');
        $this->form_validation->set_rules('psw2', 'Confirm Password', 'required|matches[psw1]');
        
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
        $this->form_validation->set_message('is_unique', 'Ese {field} ya se está usando');
       
        if ($this->form_validation->run() == FALSE){
            $this->load->view('v_registro');
        }else{
            $this->m_mascotas->registrarUsuario($_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['username'], $_POST['psw1']);
            $this->session->set_userdata('username',$_POST['username']);
            redirect('c_inicial/registroExitoso', 'refresh');            
        }
        
        $this->load->view("v_pie");
        $this->load->view("v_fin");        
    }
    

    
    public function iniciar_sesion(){
        $this->load->view("v_cabecera");
        
        $this->form_validation->set_rules('username', 'Nombre de usuario', 'required');
        $this->form_validation->set_rules('psw', 'Password', 'required');
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        
        if ($this->form_validation->run() != FALSE){
            $correcto = $this->m_mascotas->comprobarUsuarioContraseña($_POST['username'], $_POST['psw']);
            if($correcto){
                $this->session->set_userdata('username',$_POST['username']);
                redirect('c_inicial/index', 'refresh'); 
            } else {
                $this->load->view("v_inicio_sesion");
            }            
        }else{
            $this->load->view("v_inicio_sesion");
        }
        
        $this->load->view("v_pie");
        $this->load->view("v_fin");   
    }
    
    
    public function nueva_mascota(){
        $this->load->helper('date');
        //$this->load->view("v_cabecera");
        $this->load->view("v_nueva_mascota");
        //$this->load->view("v_pie");
        $this->load->view("v_fin"); 
    }
}

