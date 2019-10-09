<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function conectarse() {
    $cn = new mysqli("localhost","root","","bdrestaurante");
    if($cn->connect_error>0){
        die("Acceso denegado a la BBDD");
    }
    return $cn;
}
function platos($cn) {
    $todosPlatos = array();
    $sql="select idplato, nombre, precio, calorias from platos";
    $rs=$cn->query($sql);
    while ($fila = $rs->fetch_assoc()){
        $todosPlatos[] = $fila;
    }
    return $todosPlatos;
}
function clientes($cn) {
    $todosClientes = array();
    $sql="select dni, nombre, apellidos, visitas from clientes";
    $rs=$cn->query($sql);
    while ($fila = $rs->fetch_object()){
        $todosClientes[] = $fila;
    }
    return $todosClientes;
}

function aniadir_cliente($cn,$dni,$nombre,$ap){
    $sqlExiste="select dni from clientes where dni='$dni'";
    $rs=$cn->query($sqlExiste);
    if($rs->num_rows==1){
        return false;
    }else{
        $sqlAniadir="insert into clientes (dni, nombre, apellidos, visitas) values ('$dni','$nombre','$ap',0)";
        $cn->query($sqlAniadir);
        return true;        
    }
}

function grabarPedido($cn, $idsPlatos, $dni){
    $total=0;
    
    foreach ($idsPlatos as $idPlato) {
       $sqlPrecio="select precio from platos where idplato=$idPlato";
       $rs=$cn->query($sqlPrecio);
       if($fila = $rs->fetch_array()){
        $precio = $fila[0];
       }
       $total +=$precio;
    }
    
    $sqlGrabar= "intsert into pedidos (dni, total, fecha) values ($dni,$total,now())";
    $cn->query($sqlGrabar);
    return $cn ->innsert_id;
    
}

function grabarPlato($cn,$nombre,$precio,$calorias,$foto){
    $sqlnuevoPlato="insert into platos (nombre,precio,calorias,foto) values ('$nombre','$precio','$calorias','$foto')";
    $cn -> query($sqlnuevoPlato);
}