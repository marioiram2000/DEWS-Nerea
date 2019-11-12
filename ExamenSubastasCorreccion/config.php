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
    $sql = "select id from items where not exists (select pujas.id from pujas where items.id = pujas.id_item)";
    $rs = $cn->query($sql);
    while ($fila=$rs->fetch_object()){
        $items[] = $fila;
    }
    return $items;
    
}