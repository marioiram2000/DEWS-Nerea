<?php

require_once 'config.php';

//conectar a bbdd
function conectarBBDD() {
    $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if (!mysqli_select_db($cn, DB_DATABASE)) {
       /*if ($_SERVER['PHP_SELF'] != APP_RUTA."insertardatos.php") {
            header("Location: insertardatos.php");
            die();
        }*/ 
    }
    if (mysqli_connect_errno() > 0 ) {
        die();
    }
    
    mysqli_set_charset($cn, "utf8");
    return $cn;
}
$db = conectarBBDD();

function getItem($db, $id_item) {
    $sql = "SELECT items.`nombre`,`id_cat`,`fechafin`,`id_user`,`preciopartida`,`descripcion`, usuarios.nombre nombreUsuario "
            . "FROM `items` "
            . "LEFT JOIN usuarios ON usuarios.id = items.id_user "
            . "WHERE items.id = ".$id_item;
    $rs = mysqli_query($db, $sql);
    if (mysqli_affected_rows($db) == 1) {
        $fila = mysqli_fetch_assoc($rs);
        return $fila;
    }
    return false;
}
function getItemsVencidosSinPuja($db) {
    $sql = "SELECT `id`, `id_cat`, `id_user`, `nombre`, `preciopartida`, `descripcion`, `fechafin` "
            . "FROM `items` "
            . "WHERE `fechafin` < CURRENT_TIMESTAMP "
            . "AND id NOT IN (SELECT id_item from pujas) ORDER BY id_cat";
    $rs = mysqli_query($db, $sql);
    $items = array();
    while ($fila = mysqli_fetch_assoc($rs)) {
        $items[] = $fila;
    }
    return $items;
}
function getItemsActivos($db) {
    $sql = "SELECT `id`, `id_cat`, `id_user`, `nombre`, `preciopartida`, "
        . "`descripcion`, `fechafin` FROM `items` "
        . "WHERE `fechafin` > CURRENT_TIMESTAMP ";
    $rs = mysqli_query($db, $sql);
    $items = array();
    while ($fila = mysqli_fetch_assoc($rs)) {
        $items[$fila['id']] = $fila;
    }
    return $items;
    
}

function getCategorias($db) {
   $sql = "SELECT `id`, `categoria` FROM `categorias`";
   $rs = mysqli_query($db, $sql);
   $categorias = array();
    while ($fila = mysqli_fetch_assoc($rs)) {
        $categorias[$fila['id']] = $fila['categoria'];
    }
    return $categorias;
}

function getUltimaPuja($db, $id_item) {
    $sql="SELECT `id`,`id_user`,`cantidad` FROM `pujas` WHERE `id_item` = ".$id_item." ORDER BY `pujas`.`id` DESC";
    $rs = mysqli_query($db, $sql);
    if ($fila = mysqli_fetch_assoc($rs)) {
        return $fila['cantidad'];
    }
    return false;
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

function pujaFicticia($db, $id_item, $cantidad, $usuarios) {
    //mezclar los usuarios y usar el primero
    shuffle($usuarios);
    $sql="INSERT INTO `pujas` (`id`, `id_item`, `id_user`, `cantidad`) "
            . "VALUES (NULL, '".$id_item."', '$usuarios[0]', '".$cantidad."');";
    mysqli_query($db, $sql);
    if (mysqli_affected_rows($db) == 1) {
        return true;
        
    }
    return false;
}
function usuariosFalsos($db) {
    $sql="SELECT `id` FROM `usuarios` WHERE `falso` = 1";
    $rs = mysqli_query($db, $sql);
    $usuarios = array();
    while ($fila = mysqli_fetch_assoc($rs)) {
        $usuarios[] = $fila['id'];
    }
    return $usuarios;
}

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?=$tituloWeb?> - <?=APP_NOMBRE?></title>
        <link href="<?=APP_RUTA?>css/stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="header"><h1><?=APP_NOMBRE?></h1></div>
        
        <div id="menu">
            <a href="index.php">Home</a>
        </div>
        
        <div id="container">
            <?php include 'barra.php'; ?>

            

        
        <div id="main">
            
