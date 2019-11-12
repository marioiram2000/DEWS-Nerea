<!DOCTYPE html>
<?php 
/*
* RECIVE 
*/

$hojadeestilos = base_url()."css/stylesheet.css"
        
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="<?=$hojadeestilos?>" type="text/css">
    </head>
    <body>
        <div id="header">
            <h1>TUS MASCOTAS</h1> 
            <div id="menu">
                <?php
                    $enlace = site_url()."/c_inicial/index";          
                    echo "<a href='$enlace'>Home</a>";
                    if(!isset($_SESSION['id_user'])){
                        $enlace = site_url()."/c_inicial/registro";                    
                        echo "<a href='$enlace'>Registro</a>";
                    }else{
                        echo "<a href=''>Desconectarse</a>";
                        echo "<a href=''>Nueva mascota</a>";
                    }
                ?>
            </div>
        </div>
        <div id="container">
            <div id="bar">
                <p>Busca por especies:</p>
                <ul>
                    <?php
                    /*
                    foreach ($todosGeneros as $genero) {
                        $g = $genero['genero'];
                        $enlace = site_url()."/c_prestamos/clasificar/$g";
                        echo "<li><a href='$enlace'> $g </a></li>";
                    }*/
                    ?>
                </ul>
            </div>
