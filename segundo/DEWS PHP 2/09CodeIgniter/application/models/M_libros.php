<?php

class M_libros extends CI_Model{
    
    public function cuantosLibros(){
        $rs = $this->db->query("select count(*) as n from libros");
        $n = $rs->row()->n;
        return $n;
    }
    
    public function cantAutores(){
        $rs = $this->db->query("select count(*) as n from autores");
        $n = $rs->row()->n;
        return $n;
    }
    
    public function getLibros(){
        $rs = $this->db->query("select * from libros");
        $lirbos = $rs->result();
        return $lirbos;
    }
    
    public function getLibro($idlibro){
        $rs = $this->db->query(
                 "SELECT libros.idlibro, libros.titulo, libros.paginas, libros.genero, autores.nombre as autor "
                ."FROM libros, autores "
                ."WHERE idlibro=$idlibro "
                ."AND libros.idautor = autores.idautor");
        $libro = $rs->row();
        return $libro;
    }
    
    public function prestamos($idLibro) {
        $sql = "SELECT prestamos.fecha "
                . "FROM prestamos "
                . "WHERE idLibro = $idLibro";
        $rs = $this->db->query($sql);
        return $rs->result();
    }
    
    public function insertAutor($nombre, $fechanac, $nacionalidad){
        $sql = "SELECT nombre from autores where nombre = '$nombre'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()==1){
            return false;
        }
        
        $sql = "INSERT INTO autores (nombre, fechanac, nacionalidad)"
               ."VALUES ('$nombre', '$fechanac', '$nacionalidad')";
        //query en consultas de actualización devuelve true o false
        $rs = $this->db->query($sql);
        if($rs){
            return true;
        }
        return false;
    }
    
    public function getAutores(){
        $rs = $this->db->query("select * from autores");
        $autores = $rs->result_array();
        return $autores;
    }
    
    public function getAutor($idAutor){
        $rs = $this->db->query("select * from autores where idautor = $idAutor");
        $autor = $rs->row_array();
        return $autor;
    }
    
    public function getLibrosAutor($idAutor){
        $rs = $this->db->query("select * from libros where idautor = $idAutor");
        $libros = $rs->result_array();
        return $libros;
    }
    
    public function login($dni, $pas) {
        $sql = "SELECT dni, nombre FROM empleados WHERE dni = '$dni' AND password='$pas'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()==0){
            return null;
        }else{
            return $rs->row();
        }
    }
    
    public function getPrestamos(){
        $sql = "SELECT prestamos.idprestamo, prestamos.fecha, libros.titulo, prestamos.fechadevolucion "
                . "FROM prestamos, libros "
                . "WHERE prestamos.idlibro = libros.idlibro";
        $rs = $this->db->query($sql);
        return $rs->result();
    }
    
    public function devolverPrestamos($prestamos) {
        $devueltos = 0;
        $sql = "UPDATE prestamos SET fechadevolucion = NOW() where idprestamo = ";
        foreach ($prestamos as $prestamo) {
            $this->db->query($sql.$prestamo);
            $devueltos++;
        }
        return $devueltos;
    }
}