<?php

//FUNCION PARA CONECTARSE A LA BASE DE DATOS
function conectarse() {
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_DATABASE", "bdbus");
    $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    if (mysqli_connect_errno()> 0 ) {
        die("Acceso denegado BBDD");
    }
    return $cn;
}

//
function getAutobuses($cn){
    $sql = "select id_placa, imagen from buses";
    $rs = mysqli_query($cn, $sql);
    $buses=[];
    while($fila = $rs->fetch_object()){
        $buses[]=$fila;
    }
    return $buses;
}

function sacarmarca($imagen){
    $array = explode(" ", $imagen);
    $marca = $array[0];
    $resul = strtoupper($marca[0]);
    for ($i = 1; $i < strlen($marca); $i++) {
        $resul.=$marca[$i];
    }
    return $resul;
}

function getRutas($cn, $id_placa){
    $sql = "select id_ruta, ciudadorigen, ciudaddestino, horasalida "
            . "from rutas "
            . "where id_placa = '$id_placa' "
            . "order by horasalida";
    $rs = mysqli_query($cn, $sql);
    $rutas = array();
    $rutas['cantidad']=$rs->num_rows;
    while ($fila = mysqli_fetch_assoc($rs)){
        $rutas[] = $fila;
    }
    return $rutas;
}

function getCapacidad($cn, $id_placa){
    $sql = "select capacidad from buses where id_placa = '$id_placa'";
    $rs = mysqli_query($cn, $sql);
    $capacidad = $rs->fetch_object();
    return $capacidad->capacidad;
    
}

function getReservas($cn, $id_ruta){
    $sql = "select numasiento from reservas where id_ruta=$id_ruta";
    $rs = mysqli_query($cn, $sql);
    $asientos=array();
    while ($asiento = $rs->fetch_object()) {
        $asientos[] = $asiento->numasiento;
    }
    return $asientos;
}

function buscarDni($cn, $dni){
    $sql = "select id_dni from clientes where id_dni=$dni";
    $rs = mysqli_query($cn, $sql);
    if($rs->num_rows==0){
        return false;
    }
    return true;
    
}

function sacarprecio($cn, $id_ruta){
    $sql = "select tarifa from rutas where id_ruta=$id_ruta";
    $rs = mysqli_query($cn, $sql);
    $resul = $rs->fetch_object();
    return $resul->tarifa;
}

function reservar($cn,$id_ruta, $cantidad, $dni){
    $sql = "insert into reservas (pagado, numasiento, id_dni, id_ruta) values (0, $value, )";
    $rs = mysqli_query($cn, $sql);
}