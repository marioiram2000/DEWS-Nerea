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
    
    public function registro(){
        $this->load->view("v_cabecera");
        
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('correo', 'Correo', 'required|callback_correo_check');
        $this->form_validation->set_rules('username', 'Nombre de usuario', 'required|callback_username_check');
        $this->form_validation->set_rules('psw1', 'Password', 'required');
        $this->form_validation->set_rules('psw2', 'Confirm Password', 'required|matches[psw1]');//''
        
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
       
        if ($this->form_validation->run() == FALSE){
            $this->load->view('v_registro');
        }else{
            $this->m_mascotas->registrarUsuario($_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['username'], $_POST['psw1']);
            $this->session->set_userdata('username',$_POST['username']);
            redirect('c_inicial/index', 'refresh');            
        }
        
        $this->load->view("v_pie");
        $this->load->view("v_fin");        
    }
    
    public function correo_check($correo){
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $this->form_validation->set_message('correo_check', 'El correo ya se está usando');
            return $this->m_mascotas->comprobarUsername($correo); 
        }
        $this->form_validation->set_message('correo_check', 'El correo no es valido');
        return false;
    }
    
    public function username_check($username){
        $resul = $this->m_mascotas->comprobarUsername($username);
        if($resul){
            return true;
        }
        $this->form_validation->set_message('username_check', 'El nombre de usuario ya se está usando');
        return false;
    }
    
    public function iniciar_sesion(){
        $this->load->view("v_cabecera");
        
        $this->form_validation->set_rules('username', 'Nombre de usuario', 'required');
        $this->form_validation->set_rules('psw', 'Password', 'required');
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        
        if(isset($_POST['submit'])){
            $correcto = $this->m_mascotas->comprobarUsuarioContraseña($_POST['username'], $_POST['pas']);
        }
        
        if ($this->form_validation->run() != FALSE  && $correcto){
            $this->session->set_userdata('username',$_POST['username']);
            redirect('c_inicial/index', 'refresh'); 
        }else{
            $this->load->view("v_inicio_sesion");
        }
        
        $this->load->view("v_pie");
        $this->load->view("v_fin");   
    }
    
    
    
    public function desconectarse(){
        $this->session->sess_destroy();
        $this->load->view("v_cabecera");
        $this->load->view("v_inicio");
        $this->load->view("v_pie");
        $this->load->view("v_fin");
    }
    
    
}
