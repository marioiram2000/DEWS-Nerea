<?php

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

function items_vencidos_sin_pujas($cn){
    $items = array();
    $sql = "select id, nombre, id_cat, fechafin "
            . "from items "
            . "where `fechafin` < CURRENT_TIMESTAMP "
            . "and not exists (select pujas.id from pujas where items.id = pujas.id_item)";
    $rs = $cn->query($sql);
    while ($fila=$rs->fetch_object()){
        $items[] = $fila;
    }
    return $items;   
}

function sacarCategorias($cn){
    $categorias = array();
    $sql = "select id, categoria from categorias ";
    $rs = $cn->query($sql);
    while ($fila=$rs->fetch_object()){
        $categorias[$fila->id] = $fila->categoria;
    }
    return $categorias;   
}

function sacarItem($cn, $id){
    $sql = "select items.preciopartida as preciopartida, items.descripcion as descripcion, usuarios.nombre as nombre from items, usuarios where usuarios.id = items.id_user and items.id=$id";
    
    $rs = $cn->query($sql);
    
    if($rs->num_rows==1){
        $resul = $rs->fetch_object();
        return $resul;
    }
    return false;
}

function sacarImagenes($cn, $id_item){
    $sql = "select imagenblob from imagenes where id_item = ".$id_item;
    $rs = $cn->query($sql);
    $imagenes = array();
    $cont = 0;
    while ($fila=$rs->fetch_assoc() && $cont<3){ 
        $imagenes[] = $fila['imagenblob'];
        echo "imagen:".$fila['imagenblob'];
        $cont ++;
    }
    return $imagenes;
}

function getImagenes($db, $id_item) {
    $sql="SELECT `id`,`imagenblob` FROM `imagenes` "
            . "WHERE `id_item` = ".$id_item." ORDER BY id LIMIT 3";
    $rs = mysqli_query($db, $sql);
    $imagenes = array();
    while ($fila = mysqli_fetch_assoc($rs)) {
        $imagenes[] = $fila['imagenblob'];
    }
    return $imagenes;
    
}