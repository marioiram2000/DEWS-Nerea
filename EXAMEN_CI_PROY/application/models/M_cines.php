<?php
class M_cines extends CI_Model{
    function __construct() {
        parent::__construct();        
        $db=$this->load->database();
    }
    
    function sacarCines(){
        $cines = array();
        $rs= $this->db->query("select nombre from cines");
        foreach ($rs->result() as $row)
        {
            $cines[] = $row->nombre;
        }        
        return $cines;
    }
    
    function sacarPeliculas($nombre, $fecha){
        $query = "select idcine from cines where nombre = '$nombre'";
        $rs = $this->db->query($query);
        $idcine = $rs->row()->idcine;
        
        $query = "select funciones.idfuncion, funciones.num_sala, funciones.hora, funciones.precio_entrada, peliculas.titulo "
                . "from funciones, peliculas"
                . " where idcine = '$idcine' "
                . " and funciones.dia = '$fecha' "
                . " and funciones.idpelicula = peliculas.idpelicula";
        
        $rs = $this->db->query($query);
        //echo "<br>$query<br>";
        return $rs->result_array();    
    }
    function comprobarSitios($idfuncion, $num_sala){
        
        $query = "select capacidad from salas where numero = '$num_sala'";
        $rs = $this->db->query($query);
        $capacidad = $rs->row()->capacidad;
        
        $query = "select vendidas from funciones where idfuncion = '$idfuncion'";
        $rs = $this->db->query($query);
        $resultado = $rs->row();
        $vendidas = $resultado->vendidas;
        /*
        echo "Vendidas: $vendidas<br>Capacidad:$capacidad";
        exit();*/
        if(intval($vendidas)<intval($capacidad)){
            return true;
        }else{
            return false;
        }
    }
    
    function comprarEntrada($idfuncion){
        $query = "select vendidas from funciones where idfuncion = '$idfuncion'";
        $rs = $this->db->query($query);
        $vendidas = $rs->row()->vendidas;
        $vendidas ++;
        
        $this->db->set('vendidas', "$vendidas");
        $this->db->where('idfuncion', $idfuncion);
        $this->db->update('funciones'); 
    }
}