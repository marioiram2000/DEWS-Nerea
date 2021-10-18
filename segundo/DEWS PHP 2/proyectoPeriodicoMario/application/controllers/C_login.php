<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {
    
    function index(){
        $dataBarra['tipos'] = $this->m_periodico->getTipos();
        
        $this->load->view('header');
        $this->load->view('barra',$dataBarra);
        $this->load->view('login');
        $this->load->view('footer');
    }
    
    function login(){
        $this->form_validation->set_rules('correo', 'Correo', 'required');
        $this->form_validation->set_rules('psw', 'Contraseña', 'required');
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        
        if ($this->form_validation->run() != FALSE){
            $usu = $this->m_periodico->comprobarLogin($_POST['correo'], $_POST['psw']);
            if($usu==null){
                $dataBarra['tipos'] = $this->m_periodico->getTipos();
                $dataBarra['error'] = "Datos de acceso incorrectos";
                $this->load->view('header');
                $this->load->view('barra',$dataBarra);
                $this->load->view('login');
                $this->load->view('footer');
            }else{
                $this->session->set_userdata('uid', $usu['id']);                
                if(count($usu)==5){
                    $this->session->set_userdata('usuario', $usu);         
                }else{
                    $this->session->set_userdata('periodista', $usu);        
                    if($this->m_periodico->comprobarAdmin($usu['id'])){
                        $this->session->set_userdata('admin', true);
                    }
                }
                redirect('c_index/index'); 
            }
            
        }else{
            $dataBarra['tipos'] = $this->m_periodico->getTipos();
            $this->load->view('header');
            $this->load->view('barra',$dataBarra);
            $this->load->view('login');
            $this->load->view('footer');
        }
    }
    
    function logout(){
        $this->session->unset_userdata('uid');   
        $this->session->unset_userdata('usuario');   
        $this->session->unset_userdata('periodista');   
        $this->session->unset_userdata('admin');
        $this->session->unset_userdata('invitado');
        redirect('c_index/index'); 
    }
}