<?php

class C_formularios extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model("m_mascotas");
    }
    
    /*FORMULARIO DE REGISTRO DE UN USUARIO NUEVO*/
    public function registro(){
        $this->load->view("v_cabecera");
        
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('correo', 'Correo', 'required|is_unique[usuarios.correo]');
        $this->form_validation->set_rules('username', 'Nombre de usuario', 'required|is_unique[usuarios.username]');
        $this->form_validation->set_rules('psw1', 'Password', 'required');
        $this->form_validation->set_rules('psw2', 'Confirm Password', 'required|matches[psw1]');//''
        
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
       $this->form_validation->set_message('is_unique', 'Ese {field} ya se está usando');
       
        if ($this->form_validation->run() == FALSE){
            $this->load->view('v_registro');
        }else{
            $this->m_mascotas->registrarUsuario(trim($_POST['nombre']), trim($_POST['apellidos']), trim($_POST['correo']), trim($_POST['username']), trim($_POST['psw1']));
            $this->session->set_userdata('username',$_POST['username']);
            redirect('c_inicial/index', 'refresh');            
        }
        
        $this->load->view("v_pie");
        $this->load->view("v_fin");        
    }
    
    
    /*FORMULARIO DE INICIO DE SESION*/
    public function iniciar_sesion(){
        $this->load->view("v_cabecera");
        
        $this->form_validation->set_rules('username', 'Nombre de usuario', 'required');
        $this->form_validation->set_rules('psw', 'Password', 'required');
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        
        if ($this->form_validation->run() != FALSE ){
            $correcto = $this->m_mascotas->comprobarUsuarioContraseña($_POST['username'], $_POST['psw']);
            if($correcto){
                /*echo "<p style='z-index: 5; color: red;'>----------Correcto true ---------------</p>";*/
                $this->session->set_userdata('username',$_POST['username']);
                redirect('c_inicial/index', 'refresh');
            }else{
                /*echo "<p style='z-index: 5; color: red;'>----------Correcto false ---------------</p>";*/
            }
        }else{
            $this->load->view("v_inicio_sesion");
            /*echo "<p style='z-index: 5; color: red;'>----------LA validacion es false---------------</p>";*/
        }
        
        $this->load->view("v_pie");
        $this->load->view("v_fin");  
    }
    
    

    
    
}
