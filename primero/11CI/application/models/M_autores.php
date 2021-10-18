<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_autores extends CI_Model{
    
    
     // $rs->result()  (Array de objetos)
        // $rs->result_array()  (Array de arrays asociatios)
        // $rs->row()     (1 objeto)
        // $rs->row_array() (1 array asociativo)
        // $rs->num_rows()
        // $db->affected_rows()
        // $db->insert_id()
    
    
    function __construct() {
        parent::__construct();        
       // $db=$this->load->database();
    }
    
    function cuantoslibros(){        
        $rs=$this->db->query("select count(idlibro) as cuantos from libros");
        return $rs->row()->cuantos;
        
    }
    
    function libros(){
        $rs=$this->db->query("select idlibro,titulo, paginas from libros");
        return $rs->result();
    }
    
    function autores(){
        $rs=$this->db->query("select idautor,nombre,fechanac,nacionalidad from autores");
        return $rs->result();
    }
    
    
    
    
    
    
}

