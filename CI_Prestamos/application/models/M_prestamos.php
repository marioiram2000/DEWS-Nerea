<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_prestamos extends CI_Model{
    
    function __construct() {
        parent::__construct();        
        $db=$this->load->database();
    }
    
    function todosGeneros(){
        $rs=$this->db->query("select distinct(genero) from libros");
        $generos = $rs->result_array();
        return $generos;
    }
    
    function librosPorGenero($genero){
        $rs=$this->db->query("select idlibro, titulo, idautor from libros where genero='$genero'");
        $libros = $rs->result_array();
        return $libros;
    }
    
    function codificarLibros($libros){
        //PoesiaArray ( [0] => Array ( [idlibro] => 10 [titulo] => Viaje del Parnaso [idautor] => 2 ) )
        $resul = array();
        foreach ($libros as $libro) {
            $rs=$this->db->query("select nombre from autores where idautor='".$libro['idautor']."'");
            $autor=$rs->row()->nombre;
            $resul[]['idlibro'] = $libro['idlibro'];
            $resul[]['titulo'] = $libro['titulo'];
            $resul[]['autor'] = $libro[];
        }
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}