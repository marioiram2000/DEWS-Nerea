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
        //$this->form_validation->set_message('required', 'El campo es obligatorio');
        
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
        
        $this->load->view("v_cabecera");
        
        $this->form_validation->set_rules("nombre", "nombre", 'required');
        $this->form_validation->set_rules("edad", "edad", 'required');
        $this->form_validation->set_rules('especie', 'especie', 'required');
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        
        if ($this->form_validation->run() != FALSE){
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];
            $especie = $_POST['especie'];
            $ruta = "imagenes/".$_POST['imagen'];
            $usuario = $this->session->userdata('username');
            $ingresada = $this->m_mascotas->nuevaMascota($usuario, $nombre, $edad, strtoupper($especie), $ruta);
            if($ingresada){
                $this->load->view("v_nueva_mascota_exito");
            }else{
                $this->load->view("v_nueva_mascota");
            } 
            
        }else{
            $this->load->view("v_nueva_mascota");
        }        
        $this->load->view("v_pie");
        $this->load->view("v_fin"); 
    }
    
    public function gestionFotos($id_mascota){
        
        if(isset($_POST['subir'])){
            $this->form_validation->set_rules('imagen', 'imagen', 'required');
            if ($this->form_validation->run() != FALSE){
                $ruta = $_POST['imagen'];
                $this->m_mascotas->subirImagen($id_mascota, $ruta);
                redirect('c_formularios/gestionFotos/'.$id_mascota, 'refresh');
            } 
        }
        if(isset($_POST['borrar'])){
            $this->form_validation->set_rules('ruta', 'ruta', 'required');
            if ($this->form_validation->run() != FALSE){
                $ruta = $_POST['ruta'];
                $this->m_mascotas->borrarImagen($id_mascota, $ruta);
                redirect('c_formularios/gestionFotos/'.$id_mascota, 'refresh');
            } 
        }
       
                  
        
        $data['imagenes'] = $this->m_mascotas->sacarFotosMacota($id_mascota);
        
        if($data['imagenes']==false){
            $this->m_mascotas->borrar_mascota($id_mascota);
        }
        $data['id_mascota'] = $id_mascota;
        
        $this->load->view("v_cabecera");
        $this->load->view("v_gestion_fotos", $data);
        $this->load->view("v_pie");
        $this->load->view("v_fin");
    }
}

