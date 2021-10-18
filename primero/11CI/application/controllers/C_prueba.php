<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Prueba extends CI_Controller {

    /*
        public function saludar(){
            echo "Buenos dias";
        }
        
        public function saludarA($nombre='anonymous'){
            echo "Buenos dias $nombre!";
        }
     * 
     */
	
	public function index()
	{
		$this->cargarTabla();
	}
        
        
        public function cargarTabla(){
            
            $ahora=time();
            $mes=date('m',$ahora);
            if ($mes==7 || $mes==8)
                $datoscab['frase']="Feliz dia vacacional...";
            else
                $datoscab['frase']="Dia ordinario....";
            
           //Datos para v_multi
            $datos['num']=7;
            $datos['cantfactores']=10;
            
            $this->load->view("v_cabecera",$datoscab);
            $this->load->view("v_multi",$datos);
            $this->load->view("v_pie");
        }
        
        
        
}
