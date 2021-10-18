<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_registro extends CI_Controller {
    
    function index(){
        $dataBarra['tipos'] = $this->m_periodico->getTipos();
        
        $this->load->view('header');
        $this->load->view('barra',$dataBarra);
        $this->load->view('registro');
        $this->load->view('footer');
    }
    
    function registro(){
        $this->form_validation->set_rules('correo', 'Correo', 'required|valid_email|is_unique[usuarios.correo]');
        $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Contraseña', 'required|matches[password]');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric|min_length[8]');
        
        $this->form_validation->set_message('required', 'El {field} es obligatorio');
        $this->form_validation->set_message('valid_email', 'El correo no es valido');
        $this->form_validation->set_message('is_unique', 'El correo ya está siendo usado');
        $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
        $this->form_validation->set_message('min_length', '{field} demasiado corto');
        $this->form_validation->set_message('max_length', '{field} demasiado largo');
        $this->form_validation->set_message('numeric', 'Telefono invalido');
        
        if ($this->form_validation->run() != FALSE){
            
            $this->m_periodico->insertUsuario($_POST['nombre'], password_hash($_POST['password'], PASSWORD_BCRYPT), $_POST['correo'], $_POST['telefono']);
            $dataBarra['tipos'] = $this->m_periodico->getTipos();
            $this->load->view('header');
            $this->load->view('barra',$dataBarra);
            $this->load->view('registrado');
            $this->load->view('footer');
        }else{
            $dataBarra['tipos'] = $this->m_periodico->getTipos();
        
            $this->load->view('header');
            $this->load->view('barra',$dataBarra);
            $this->load->view('registro');
            $this->load->view('footer');
        }
        
        
    }
    
}