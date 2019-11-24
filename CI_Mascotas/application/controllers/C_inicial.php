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
    
    public function registroExitoso(){
        $this->load->view("v_cabecera");
        $this->load->view("v_registrado");
        $this->load->view("v_pie");
        $this->load->view("v_fin");
    }
    
    public function desconectarse(){
        $this->session->sess_destroy();
        redirect('c_inicial/index', 'refresh');     
    }
    
    public function perfil(){
        $username = $this->session->userdata('username');
        $mascotas= $this->m_mascotas->sacarMascotasDeUsuario($username);
        $aux=array();
        $cont = 0;
        foreach ($mascotas as $mascota) {//[id_mascota] => 2  [nombre] => cuscus      [edad] => 8   [especie] => Gato            
            $aux[$cont]['id_mascota']=$mascota['id_mascota'];
            $aux[$cont]['nombre']=$mascota['nombre'];
            $aux[$cont]['edad']=$mascota['edad'];
            $aux[$cont]['especie']=$mascota['especie'];
            $imagenes = $this->m_mascotas->sacarFotosMacota($mascota['id_mascota']);
                        
            foreach ($imagenes as $imagen) {                
                $aux[$cont]['imagenes'][]=$imagen['ruta'];
            }
            
            $cont++;
        }        
        $data['mascotas']=$aux; 
        
        $this->load->view("v_cabecera");
        $this->load->view("v_perfil", $data);
        $this->load->view("v_pie");
        $this->load->view("v_fin");
    }
    
    public function verEspecie($especie){
        $data['imagenes']=$this->m_mascotas->sacarFotosEspecie($especie);    
        $data['especie']=$especie;
        
        $this->load->view("v_cabecera");
        $this->load->view("v_especie", $data);
        $this->load->view("v_pie");
        $this->load->view("v_fin");
    }
}
