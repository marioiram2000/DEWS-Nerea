<?php
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "bdrestaurante");

function conexion(){
    $cn = mysqli_connect(HOST, USER, PASS, DB);
    if(mysqli_errno($cn)>0){
        return false;
    }
    return $cn;
}

function insertarAlimentoAhora($nombre,$precio,$tipo, $con){
    $sql = "insert into alimentos (nombre, precio, tipo, fecha)"
            . "values ('$nombre', $precio, '$tipo', now())";
    //echo $sql;
    mysqli_query($con, $sql);
}

function alimentos($con, $tipo=""){
    $alims = array();
    if($tipo==""){
        $sql = "select id, nombre, precio, tipo, fecha from alimentos";
    } else {
        $sql = "select id, nombre, precio, tipo, fecha from alimentos where tipo = '$tipo'";
    }
    
    $rs = mysqli_query($con, $sql);
    while ($fila = mysqli_fetch_assoc($rs)){
        $alims[] = $fila;
    }
    return $alims;
}

function actualizarAlimentosAntiguos($con){
    $sql = "update alimentos set fecha=now() where fecha < '2020/01/01'";
    mysqli_query($con, $sql);
    return mysqli_affected_rows($con);
}

function tipos($con){
    $tipos = [];
    $sql = "select distinct tipo from alimentos";
    $rs = mysqli_query($con, $sql);
    while($fila = mysqli_fetch_array($rs)){
        $tipos[] = $fila[0];
    }
    return $tipos;
}

function registrar($con, $dni, $nombre){
    $sql = "select idcliente from clientes where idcliente='$dni'";
    $rs = mysqli_query($con, $sql);
    
    //if(mysqli_num_rows($rs)==1){
    if($fila = mysqli_fetch_assoc($rs)){
        return false;
    }
    else{
        $sql = "INSERT INTO clientes (idcliente, nombre) VALUES ('$dni', '$nombre')";
        $rs = mysqli_query($con, $sql);
        return true;
        
    }
}

function alimentos2($con){
    $alims = array();
    $sql = "select id, nombre, precio, tipo, fecha from alimentos";
    $rs = mysqli_query($con, $sql);
    while ($alimento = mysqli_fetch_object($rs)){
        $alims[] = $alimento;
    }
    return $alims;
}

function getPrecio($idalimento, $con){
    $alims = array();
    $sql = "select precio from alimentos where id ='$idalimento'";
    $rs = mysqli_query($con, $sql);
    if($alimento= mysqli_fetch_object($rs)){
        return $alimento->precio;
    }
    return -1;
}

function nuevoPedido($link,$idcliente,$total){
    $query = "insert into pedidos (idcliente, preciototal) values ('$idcliente', '$total')";
    $rs = mysqli_query($link, $query);
    if(mysqli_affected_rows($link)==1){
        return mysqli_insert_id($link);
    }
    return -1;
}

function alimentos3($con){
    $alims = array();
    $sql = "select id, nombre, precio, tipo, fecha, imagen from alimentos";
    $rs = mysqli_query($con, $sql);
    while ($alimento = mysqli_fetch_object($rs)){
        $alims[] = $alimento;
    }
    return $alims;
}

function guardarimagen($con,$idalimento, $blobimagen){
    $sql = "update alimentos set imagen = '$blobimagen' where id = '$idalimento'";
    $result = mysqli_query($con, $sql);
    if(mysqli_affected_rows($con)==1){
        return true;
    }
    return false;
    
}

function getClientes($link){
    $cientes = array();
    $sql = "SELECT idcliente, nombre, imagen FROM clientes";
    $result = mysqli_query($link, $sql);
    while($cliente = mysqli_fetch_assoc($result)){
        $clientes[] = $cliente;
    }
    return $clientes;
}

function setImgCliente($link, $idcliente, $img){
    $query = "update clientes set imagen = '$img' where idcliente = '$idcliente'";
    $rs = mysqli_query($link, $query);
    if(mysqli_affected_rows($link)==1){
        return true;
    }
    return false;
}

function getPedidosCliente($link, $idcliente){
    $pedidos = array();
    
    $query = "SELECT idpedido, idcliente, preciototal FROM pedidos where idcliente = '$idcliente'";
    $rs = mysqli_query($link, $query);
    
    while($pedido = mysqli_fetch_assoc($rs)){
        $pedidos[] = $pedido;
    }
    return $pedidos;
}
