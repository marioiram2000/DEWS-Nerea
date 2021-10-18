<?php

session_start();
include 'config.php';
include 'bbdd.php';

$link = conexion();
if($link==false){
    echo "<h1 style='color:red;'>No se ha podido conectar a la base de datos</h1>";
}
mysqli_set_charset($link, "utf8");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SUBASTAS CIUDAD JARDIN</title>
        <link rel="stylesheet" href="css/estilos.css"/>
    </head>
    <body>
        <div id="header">
            <h1>SUBASTAS CIUDAD JARDIN</h1>
        </div>
        <div id="menu">
            <a href="index.php">Home </a>
        </div>
        <div id="container">
            <div id="bar">
                <?php   require 'barra.php';    ?>
            </div>
            <div id="main">