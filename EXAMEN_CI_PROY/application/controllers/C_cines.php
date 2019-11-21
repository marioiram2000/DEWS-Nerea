<?php

class C_cines extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model("m_cines");
    }
    
    public function index()
    {
        $this->load->view("v_cabecera");
        
        $datos = array();
        $cines = $this->m_cines->sacarCines();        
        $datos['cines']=$cines;     
       
        $this->form_validation->set_rules('cine[]', 'cine', 'required');
        
        $this->form_validation->set_message('required', 'El cine es obligatorio');
        
        if ($this->form_validation->run() == FALSE){
            $this->load->view("v_paso1", $datos);
        }else{
            $this->session->set_userdata('dia', $_POST['dia']);
            $this->session->set_userdata('mes', $_POST['mes']);
            $this->session->set_userdata('ano', $_POST['ano']);
            $this->session->set_userdata('cine', $_POST['cine'][0]);
            
            redirect('c_cines/paso2', 'refresh');            
        }
        
        
        
        
        
        $this->load->view("v_pie");
    }   
    
    public function paso2()
    {
        $this->load->view("v_cabecera");
        
        $datos = array();
        
        $cines = $this->m_cines->sacarCines();        
        $datos['cines']=$cines; 
        
        $dia= $this->session->userdata('dia');
        $mes= $this->session->userdata('mes');
        $ano= $this->session->userdata('ano');
        $cine= $this->session->userdata('cine');
        
        $fecha = date("Y-m-d", strtotime($dia."-".$mes."-".$ano));
        
        $funciones = $this->m_cines->sacarPeliculas($cine, $fecha);
        $resultados['funciones']=$funciones;
        $resultados['dia']=$fecha;
        $resultados['cine']=$cine;
        
        $this->load->view("v_paso1", $datos);
        $this->load->view("v_paso2", $resultados);
        
        
        $this->load->view("v_pie");
        
    }
    
    
    public function paso3($idfuncion, $num_sala, $precio_entrada){
        //$this->load->view("v_cabecera");
        
        $datos = array();
        
        $cines = $this->m_cines->sacarCines();        
        $datos['cines']=$cines; 
        
        $dia= $this->session->userdata('dia');
        $mes= $this->session->userdata('mes');
        $ano= $this->session->userdata('ano');
        $cine= $this->session->userdata('cine');
        
        $fecha = date("Y-m-d", strtotime($dia."-".$mes."-".$ano));
        
        $funciones = $this->m_cines->sacarPeliculas($cine, $fecha);
        $resultados['funciones']=$funciones;
        $resultados['dia']=$fecha;
        $resultados['cine']=$cine;
        
        $this->load->view("v_paso1", $datos);
        $this->load->view("v_paso2", $resultados);
        
        $compra = array();
        $quedan = $this->m_cines->comprobarSitios($idfuncion, $num_sala);
        if($quedan){
            $compra['realizada']=true;
            if($this->session->userdata('total')!=null){
                $total = $this->session->userdata('total');
                $total += $precio_entrada;
                $this->session->set_userdata('total', $total);
            }else{
                $this->session->set_userdata('total', $precio_entrada);
            }
            $this->m_cines->comprarEntrada($idfuncion);
            
        }else{
            $compra['realizada']=false;
        }
        $compra['total']= $this->session->userdata('total');
        $compra['funcion']=$idfuncion;
        
        $this->load->view("v_paso3", $compra);
        
        $this->load->view("v_pie");
    }
   
}
