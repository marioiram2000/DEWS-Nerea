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
        print_r($libros);
        foreach ($libros as $libro) {
            $rs=$this->db->query("select nombre from autores where idautor=".$libro['idautor']);
            $autor=$rs->row();
            $id = $libro['idlibro'];
            $resul[$id]['id']=$id;
            $resul[$id]['titulo']= $libro['titulo'];
            $resul[$id]['autor'] = $autor->nombre;  
        }
        return $resul;
    }
    
    function prestar($idlibro){
        $insertado=false;
        if($this->m_prestamos->comprobarPrestamos($idlibro)){
            $fecha_actual = strtotime(date("d-m-Y H:i",time()));
            $sql = "insert into prestamos (fecha, idlibro) values ('$fecha_actual', $idlibro)";
            $insertado=$this->db->query($sql);
        }        
        return $insertado;
        
    }
    
    function comprobarPrestamos($idlibro){
        $rs=$this->db->query("select count(idlibro) cuantos from prestamos where idlibro=$idlibro");
        $resul = $rs->row()->cuantos;
        if($resul<4){
            return true;
        }
        return FALSE;
    }
    
    function recorrerPrestamos($libros_seleccionados){
        $introducidos = array();
        foreach ($libros_seleccionados as $idlibro) {            
            $resul = $this->m_prestamos->prestar($idlibro);
            if($resul){
                $titulo = $this->db->query("select titulo from libros where idlibro=$idlibro");
                $introducidos[]=$titulo->row()->titulo;
            }
        }
        return $introducidos;
    }
    
    
    
    
    
    
    
    
    
    
    
}