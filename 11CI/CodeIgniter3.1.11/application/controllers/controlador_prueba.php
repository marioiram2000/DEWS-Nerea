<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_prueba extends CI_Controller {

    public function saludar(){
        echo "buenos dias";
    }

    public function saludarA($nombre='anonimo'){//anonimo es el valor por defecto, tiene que tener ' y no "
        echo "Buenos dias $nombre";
    }

    public function index()
	{
		$this->load->view('welcome_message');
	}
}
