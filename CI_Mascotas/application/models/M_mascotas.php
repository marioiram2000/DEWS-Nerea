<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class M_mascotas extends CI_Model{
    function __construct() {
        parent::__construct();        
        $db=$this->load->database();
    }
    
    function comprobarUsername($username){
        $rs=$this->db->query("select iduser from usuarios where username = '$username'");
        if($rs->num_rows() == 0){
            return true;
        }
        return false;
    }
    function comprobarCorreo($correo){
    $rs=$this->db->query("select iduser from usuarios where correo = '$correo'");
    if($rs->num_rows() == 0){
        return true;
    }
    return false;
    }
    
    function registrarUsuario($nombre, $apellidos, $correo, $username, $password){
        $imagen = addslashes(file_get_contents("imagenes/usuario.png"));
        $data = array(
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'correo' => $correo,
            'username' => $username,
            'password' => $password,
            'imagen' => $imagen
        );
        if($this->db->insert('usuarios', $data)){
            return $this->db->insert_id();
        }
        return false;
    }
    
}
