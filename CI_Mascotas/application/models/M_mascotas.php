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
            return true;
        }
        return false;
    }
    
    function comprobarUsuarioContraseña($usu, $pas){
        $rs= $this->db->query("select count(*) as cant from usuarios where username='$usu' and password='$pas'");
        $resul = $rs->row();
        if($resul->cant == 0){
            return false;
        }
        return true;
    }
    
}
