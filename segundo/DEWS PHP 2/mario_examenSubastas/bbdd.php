<?php
function getItemsVencidos($link){
    $sql = "SELECT * FROM items WHERE fechafin < CURRENT_DATE";
    $result = mysqli_query($link, $sql);
    $items = array();
    while ($fila = mysqli_fetch_assoc($result)){
        $items[] = $fila;
    }
    return $items;
}

function getPujas($link, $id_item){
    $pujas = array();
    $sql = "select pujas.id, pujas.cantidad, pujas.fecha, usuarios.username 
            from pujas, usuarios 
            where id_item = $id_item 
            AND usuarios.id = pujas.id_user 
            ORDER BY pujas.cantidad DESC";
    $result = mysqli_query($link, $sql);
    while ($fila = mysqli_fetch_assoc($result)){
        $pujas[] = $fila;
    }
    return $pujas;
}

function getGanadorPuja($link, $id_item){
    $cantPujas = count(getPujas($link, $id_item));
    if($cantPujas>0){
        $sql = "SELECT usuarios.nombre
                FROM usuarios, pujas 
                WHERE pujas.id_user = usuarios.id 
                and cantidad =  
                        (SELECT MAX(cantidad)
                        FROM pujas
                        where id_item = $id_item)";
        $result = mysqli_query($link, $sql);
        return mysqli_fetch_object($result)->nombre;
    }
    return false;
}

function getCategoriaItem($link, $id){
    $sql = "SELECT categoria FROM categorias WHERE id = ".$id;
    $result = mysqli_query($link, $sql);
    if($result!=false){
        $d = mysqli_fetch_object($result)->categoria;
        return $d;
    }
    return false;
}

function getPrecioActual($link, $id_item){
    $sql = "SELECT MAX(cantidad) as precio FROM pujas WHERE id_item = ".$id_item;
    $result = mysqli_query($link, $sql);
    $cant = mysqli_fetch_object($result)->precio;
    return $cant;
}

function getItemsNoVencidos($link){
    $sql = "SELECT * FROM items WHERE fechafin >= CURRENT_DATE";
    $result = mysqli_query($link, $sql);
    $items = array();
    while ($fila = mysqli_fetch_assoc($result)){
        $items[] = $fila;
    }
    return $items;
}

function getItemNombre($link, $id){
    $sql = "SELECT nombre FROM items WHERE id = ".$id;
    $result = mysqli_query($link, $sql);
    if($result!=false){
        $d = mysqli_fetch_object($result)->nombre;
        return $d;
    }
    return false;
    
}

function insertPuja($link, $id_item, $id_user, $cantidad){
    $sql = "INSERT INTO pujas (id_item, id_user, cantidad, fecha) VALUES ('$id_item', '$id_user', '$cantidad', CURRENT_DATE)";
    $result = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link)>0){
        return true;
    }
    return false;
}

function getUsuarioFalso($link){
    $sql = "SELECT id FROM usuarios WHERE falso = 0 ";
    $usuarios = array();
    $result = mysqli_query($link, $sql);
    while ($fila = mysqli_fetch_assoc($result)){
        $usuarios[] = $fila;
    }
    $i = array_rand($usuarios);
    return $usuarios[$i]['id'];
}