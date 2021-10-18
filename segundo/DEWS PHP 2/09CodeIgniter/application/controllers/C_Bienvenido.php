<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Bienvenido extends CI_Controller {

	public function index()
	{
            echo "<p>Bienvenido a la plicacion de CI</p>";
            
	}
        
        public function verHora(){
            echo date("d-M-y");
        }
        
        public function sumar($num, $num2){
            echo $num + $num2;
        }
        
}

