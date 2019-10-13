<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function conectarse(){
    
    $cn=new mysqli("localhost","root","","bdrestaurante");
    if ($cn->connect_errno>0)
        die("Acceso denegado a BBDD");
   
    return $cn;
}

function platos($cn){
    $todosplatos=array();
    $sql="select idplato, nombre, precio, calorias, foto from platos";
    $rs=$cn->query($sql);
    while ($fila=$rs->fetch_assoc()){     
        $todosplatos[]=$fila;
    }
    return $todosplatos;
}

function clientes($cn){
    $todosclientes=array();
    
    $sql="select dni, nombre, apellidos, visitas from clientes";
    $rs=$cn->query($sql);
    while ($fila=$rs->fetch_object()){     
        $todosclientes[]=$fila;
    }
    return $todosclientes;
}

function aniadir_cliente($cn, $dni,$nombre, $apellidos){
    $sqlExiste="select dni from clientes where dni='$dni'";
    $rs=$cn->query($sqlExiste);
    if ($rs->num_rows==1)
        return false;
    else{
        
        $sqlAniade="insert into clientes(dni, nombre, apellidos, visitas)"
                . " values ('$dni','$nombre','$apellidos',0)";
        $cn->query($sqlAniade);
        if ($cn->affected_rows==0)
            return false;
        else 
            return true;
    }
    
}

function grabarPedido($cn, $ids_platos, $dni){
    
    $total=0;
    foreach ($ids_platos as $idplato){
            $sqlPrecio="select precio from platos where idplato=$idplato";
            $rs=$cn->query($sqlPrecio);
            if ($fila=$rs->fetch_array())
                $precio=$fila[0];   //$fila['precio']
            $total+=$precio;
    }
    
    
    $sqlGrabar="insert into pedidos (dni, total, fecha) values ('$dni',$total,now())";
    $cn->query($sqlGrabar);   
    return $cn->insert_id; //pk autonumerica del pedido generado
            
}


function grabarPlato($cn,$nombre, $precio, $calorias, $foto){
   $sqlNuevoPlato="insert into platos (nombre, precio, calorias, foto) values ".
         " ('$nombre',$precio,$calorias,'$foto') ";
   $cn->query($sqlNuevoPlato);
}

function contarPedidos($cn, $dni){
    $sentencia="SELECT COUNT(*) cuenta from pedidos where dni='$dni'";
    $rs=$cn->query($sentencia);
    if ($fila=$rs->fetch_array())
        return $fila['cuenta'];
}

function modificarDatos($cn, $nom, $ap, $dni){
    $sentencia = "update clientes "
                ."set nombre='$nom', apellidos= '$ap' "
                ."where dni = '$dni'";
    $cn -> query($sentencia);
    if($cn->affected_rows==1){
        return true;
    }else{
        return false;
    }
}