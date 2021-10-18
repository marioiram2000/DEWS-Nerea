<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_index extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }
    
    function index(){
        if($this->session->userdata('uid')==null){
            if($this->session->userdata("invitado") == null){
                $this->session->set_userdata("invitado", array());
            }
        }
        $dataBarra['tipos'] = $this->m_periodico->getTipos();
        $dataIndex['noticias'] = $this->m_periodico->getNoticias();
        
        $this->load->view('header');
        $this->load->view('barra',$dataBarra);
        $this->load->view('index',$dataIndex);
        $this->load->view('footer');
    }
    
    function tipo($idtipo){
        $dataBarra['tipos'] = $this->m_periodico->getTipos();
        $dataBarra['idtipo'] = $idtipo;
        $dataIndex['noticias'] = $this->m_periodico->getNoticiasTipo($idtipo);
        
        
        $this->load->view('header');
        $this->load->view('barra',$dataBarra);
        $this->load->view('index',$dataIndex);
        $this->load->view('footer');
    }
    
    function limNoticias() {
        $nids = $this->session->userdata("invitado");
        $dataBarra['tipos'] = $this->m_periodico->getTipos();
        $dataIndex['noticias'] = $this->m_periodico->getXNoticias($nids);
        $this->load->view('header');
        $this->load->view('barra',$dataBarra);
        $this->load->view("limNoticias", $dataIndex);
        $this->load->view('footer');
    }
}