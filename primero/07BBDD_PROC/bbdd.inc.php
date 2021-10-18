<?php

function conectarse() {
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_DATABASE", "bdrestaurante");
    $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    if (mysqli_connect_errno()> 0 ) {
        die("Acceso denegado BBDD");
    }
    return $cn;
}

function tiposPlatos($cn) {
    $sql = "SELECT distinct tipo from platos";
    $rs = mysqli_query($cn, $sql);
    $tipos = array();
    while ($fila = mysqli_fetch_assoc($rs)) {
        $tipos[] = $fila['tipo'];
    }
    return $tipos;
}

function platosTipo($cn, $tipo) {
    $sql = "SELECT idplato, nombre, precio, tipo from platos WHERE tipo='".$tipo."'";
    $rs = mysqli_query($cn, $sql);
    $platos=array();
    while ($fila = mysqli_fetch_object($rs)) {
        $platos[]=$fila;
    }
    return $platos;
    
}

function subirPrecio($cn, $plato, $cantidad) {
    $sql = "UPDATE `platos` SET `precio` = `precio` + '".$cantidad."' "
            . "WHERE `platos`.`idplato` = ".$plato.";";
    $rs = mysqli_query($cn, $sql);
    if (mysqli_affected_rows($cn) == 1 ){
        return true;
    }
    return false;
}