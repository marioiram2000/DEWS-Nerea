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
        $rs= $this->db->query("select count(*) cont from usuarios where username='$usu' and password='$pas'");
        $resul = $rs->row();
        if($resul->cont < 1){
            //echo '  false '.$resul;            
            return false;           
        }
        return true;
    }
    
    function nuevaMascota($username, $nombre, $edad, $especie, $ruta){
        $rs= $this->db->query("insert into mascotas (username, nombre, edad, especie) values ('$username', '$nombre', '$edad', '$especie')");
        if($this->db->affected_rows()==0){
            return false;
        }
        $id = $this->db->insert_id();
        $rs= $this->db->query("insert into imagenes (id_mascota, ruta) values ('$id', '$ruta')");
        if($this->db->affected_rows()==0){
            return false;
        }
        return true;
    }
    
    function sacarMascotasDeUsuario($username){
        $rs = $this->db->query("select id_mascota, nombre, edad, especie from mascotas where username = '$username'");
        if($rs->num_rows()==0){
            return false;
        }
        return $rs->result_array();
    }
    
    function sacarFotosMacota($id_mascota){
        $rs = $this->db->query("select ruta from imagenes where id_mascota = '$id_mascota'");
        if($rs->num_rows()==0){
            return false;
        }
        return $rs->result_array();
    }
    
    function subirImagen($id_mascota, $ruta){
        $data = array(
            'id_mascota'=>$id_mascota,
            'ruta'=>'imagenes/'.$ruta
        );
        $this->db->insert('imagenes', $data);
    }

    function borrarImagen($id_mascota, $ruta){
        //$this->db->delete('mytable', array('id' => $id));  // Produces: // DELETE FROM mytable  // WHERE id = $id
        $this->db->delete('imagenes', array('id_mascota' => $id_mascota, 'ruta' => $ruta)); 
    }
    
    function borrar_mascota($id_mascota){
        $this->db->delete('mascotas', array('id_mascota' => $id_mascota)); 
    }
    
    function sacarEspecies(){
        $rs = $this->db->query("select DISTINCT especie from mascotas");
        if($rs->num_rows()==0){
            return false;
        }
        return $rs->result_array();
    }
    
    function sacarFotosEspecie($especie){
        $sql = "SELECT `ruta` FROM imagenes WHERE EXISTS (SELECT * FROM mascotas WHERE `especie` = '$especie' and mascotas.id_mascota = imagenes.id_mascota)";
        $rs = $this->db->query($sql);
        if($rs->num_rows()==0){
            return false;
        }
        return $rs->result_array();
    }
}