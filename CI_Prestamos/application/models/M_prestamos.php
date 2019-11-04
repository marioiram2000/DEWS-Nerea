<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_prestamos extends CI_Model{
    
    function __construct() {
        parent::__construct();        
       // $db=$this->load->database();
    }
    
    function todosGeneros(){
        $rs=$this->db->query("select distinct(genero) from libros");
        $generos = array();
        while ($fila=$rs->fetch_object()){     
            $generos[]=$fila;
        }
        return $generos;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}