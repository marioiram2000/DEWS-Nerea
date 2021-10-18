<?php

class M_periodico extends CI_Model{
    
    function getTipos(){
        $sql ="SELECT tipos.id, tipos.tipo, COUNT(noticias.id) as cantidad "
            . "FROM tipos, noticias "
            . "WHERE noticias.tipo = tipos.id "
            . "GROUP BY noticias.tipo";
        $rs = $this->db->query($sql);
        return $rs->result();
    }
    
    function getTodosTipos(){
        $sql ="SELECT tipos.id, tipos.tipo FROM tipos";
        $rs = $this->db->query($sql);
        return $rs->result();
    }
    
    //Obtiene las noticias sin los contenidos
    function getNoticias(){
        $sql =    "SELECT noticias.id, noticias.fecha, noticias.tipo, noticias.titulo, noticias.subtitulo, periodista.nombre "
                . "FROM noticias, periodista "
                . "WHERE noticias.pid = periodista.id "
                . "AND noticias.valida = 1 "
                . "ORDER BY noticias.fecha DESC";
        $rs = $this->db->query($sql);
        return $rs->result();
    }
    
    function getNoticiasTipo($tid){
        $sql =    "SELECT noticias.id, noticias.fecha, noticias.titulo, noticias.subtitulo, periodista.nombre "
                . "FROM noticias, periodista "
                . "WHERE noticias.pid = periodista.id "
                . "AND noticias.tipo = $tid "
                . "AND noticias.valida = 1 "
                . "ORDER BY noticias.fecha DESC";
        $rs = $this->db->query($sql);
        return $rs->result();
    }
    
    function getImgNoticia($nid){
        $rs = $this->db->query("SELECT ruta FROM imagenes WHERE nid = ".$nid);
        return $rs->row()->ruta;
    }
    
    function getNoticia($nid){
        $sql = "SELECT noticias.fecha, noticias.titulo, noticias.subtitulo, noticias.contenido, periodista.nombre, imagenes.ruta "
                . "FROM noticias, periodista, imagenes "
                . "WHERE noticias.id = $nid "
                . "AND noticias.pid = periodista.id "
                . "AND noticias.id = imagenes.nid "
                . "AND noticias.valida = 1";
        $rs = $this->db->query($sql);
        return $rs->row();
    }
    
    
    function getComentariosNoticia($nid){
        $sql = "SELECT comentarios.id, comentarios.fecha, comentarios.comentario, usuarios.nombre, comentarios.activo, usuarios.id as uid "
                . "FROM comentarios, usuarios "
                . "WHERE nid = $nid "
                . "AND comentarios.uid = usuarios.id "
                . "ORDER BY fecha DESC ";
        $rs = $this->db->query($sql);
        return $rs->result();
    }
    
    function comentar($uid, $nid, $comentario){
        $sql = "INSERT INTO comentarios (uid, nid, fecha, comentario) VALUES ($uid, $nid, CURRENT_TIME, '$comentario')";
        $this->db->query($sql);
        if($this->db->affected_rows()>0){
            return true;
        }
        return false;
    }
    
    function comprobarLogin($email, $psw){
        $sql = "SELECT * FROM usuarios WHERE correo = '$email'";
        
        $rs = $this->db->query($sql);
        if($rs->num_rows()==1){
            $usu = $rs->row_array();
            if(password_verify($psw, $usu['password'])){
                return $usu;
            }else{/*
                if($psw == $usu['password']){
                    return $usu;
                }*/
                return null;
            }
        }
        
        $sql = "SELECT * FROM periodista WHERE correo = '$email'";
        $rs = $this->db->query($sql);
        if($rs->num_rows()==1){
            $per = $rs->row_array();
            if(password_verify($psw, $per['password'])){
                return $per;
            }else{
                /*
                if($psw == $per['password']){
                    return $per;
                }*/
                return null;
            }
        }
        
        return null;
    }
    
    function insertNoticia($pid, $titulo, $subtitulo, $contenido) {        
        $sql = "INSERT INTO noticias (fecha, pid, titulo, subtitulo, contenido) "
              ."VALUES (CURRENT_DATE, '$pid', '$titulo', '$subtitulo', '$contenido')";
        $this->db->query($sql);
        return $this->db->insert_id();
    }
    
    function insertImg($nid, $ruta){
        $sql = "INSERT INTO imagenes (nid, ruta)"
              ."VALUES ($nid, '$ruta')";
        $this->db->query($sql);
        if($this->db->affected_rows()>0){
            return true;
        }
        return false;
    }
    
    function getNoticiaCheck($nid){
        $sql = "SELECT noticias.titulo, noticias.subtitulo, noticias.contenido, imagenes.ruta "
                . "FROM noticias, imagenes "
                . "WHERE noticias.id = $nid "
                . "AND noticias.id = imagenes.nid ";
        $rs = $this->db->query($sql);
        return $rs->row();
    }
    
    function comprobarAdmin($pid){
        $sql = "SELECT * FROM administradores WHERE pid = $pid";
        $rs = $this->db->query($sql);
        if($rs->num_rows()>0){
            return true;
        }
        return false;
    }
    
    function getNoticiasSinPublicar(){
        $sql =  "SELECT noticias.id, noticias.fecha, noticias.tipo, noticias.titulo, noticias.subtitulo, noticias.contenido, periodista.nombre
                FROM noticias, periodista 
                WHERE noticias.pid = periodista.id 
                AND noticias.valida = 0 
                ORDER BY noticias.fecha DESC";
        $rs = $this->db->query($sql);
        return $rs->result();
    }
    
    function publicarNoticia($tid, $nid){
        $sql = "UPDATE noticias SET tipo = $tid, valida = 1, noticias.fecha = CURRENT_DATE WHERE noticias.id = $nid";
        $this->db->query($sql);
        if($this->db->affected_rows()>0){
            return true;
        }
        return false;
    }
    
    function insertUsuario($nombre, $password, $email, $telefono){
        $sql = "INSERT INTO usuarios (nombre, password, correo, telefono) VALUES ('$nombre', '$password', '$email', '$telefono')";
        $this->db->query($sql);
        if($this->db->affected_rows()>0){
            return true;
        }
        return false;
    }
    
    function getXNoticias($nids){
        $noticias = array();
        foreach ($nids as $nid) {
            $sql =    "SELECT noticias.id, noticias.fecha, noticias.tipo, noticias.titulo, noticias.subtitulo, periodista.nombre "
                    . "FROM noticias, periodista "
                    . "WHERE noticias.pid = periodista.id "
                    . "AND noticias.id = $nid ";
                $rs = $this->db->query($sql);
                $noticias[] = $rs->row();
        }
        return $noticias;
    }
    
    function borrarComentario($cid){
        $sql = "DELETE FROM comentarios WHERE comentarios.id = $cid";
        $this->db->query($sql);
        if($this->db->affected_rows()>0){
            return true;
        }
        return false;
    }
    
    function publicarComentario($cid){
        $sql = "UPDATE comentarios SET activo = true WHERE comentarios.id = $cid";
        $this->db->query($sql);
        if($this->db->affected_rows()>0){
            return true;
        }
        return false;
    }
    
    function borrarNoticia($nid){
        $sql = "DELETE FROM noticias WHERE noticias.id = $nid";
        $this->db->query($sql);
        if($this->db->affected_rows()>0){
            return true;
        }
        return false;
    }
}

