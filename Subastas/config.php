<?php
//FUNCION PARA CONECTARSE A LA BASE DE DATOS
function conectarse() {
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_DATABASE", "bdsubastas");
    $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    if (mysqli_connect_errno()> 0 ) {
        die("Acceso denegado BBDD");
    }
    return $cn;
}
//FUNCION PARA SACAR TODAS LAS CATEGORIAS DE LA TABLA CATEGORIAS
function sacarCategorias($cn){
    $todasCategorias = array();
    $sql = "select * from categorias";
    $rs = $cn->query($sql);
    while ($fila=$rs->fetch_object()){     
        $todasCategorias[]=$fila;
    }
    return $todasCategorias;
}

//FUNCION PARA SACAR id, nombre, preciopartida, fechafin DE LOS ITEMS DE LA BASE DE DATOS ---> DATOS PARA EL INDEX
function sacarItemsIndex($cn, $categoria){
    $todositems = array();
    $sql = "select id, nombre, preciopartida, fechafin from items where id_cat='$categoria'";
    $rs = $cn->query($sql);
    while ($fila=$rs->fetch_object()){     
        $todositems[]=$fila;
    }
    return $todositems;
}

//FUNCION A LA QUE SE LE PASA UN ID DE UN ITEM Y DEVUELVE LA RUTA DE LA IMAGEN
function sacarImagen($cn, $id_item){
    $sql = "select imagen from imagenes where id_item='$id_item'";
    $rs = $cn->query($sql);
    $imagen = $rs->fetch_object();
    return $imagen;
}

//FUNCION QUE RECIVE UN ID DE UN ITEM Y DEVUELVE LA CANTIDAD DE PUJAS QUE HAY
function sacarPujas($cn, $id_item){
    $sql = "select count(*) from pujas where id_item='$id_item'";
    $rs = $cn->query($sql);
    $cont = $rs->fetch_object();
    return $cont;
}

//FUNCION QUE RECIVE UN ID DE UN ITEM Y DEVUELVE LA PUJA MÁS ALTA
function pujaMasAlta($cn, $id_item){
    $sql = "select max(cantidad) from pujas where id_item='$id_item'";
    $rs = $cn->query($sql);
    $max = $rs->fetch_object();
    if($max==0){
        $sql = "select preciopartida from items where id = '$id_item'";
        $rs = $cn->query($sql);
        $max = $rs->fetch_object();
    }
    return $max;
}