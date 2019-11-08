<!DOCTYPE html>
<?php 
/*
 * RECIVE $todosGeneros, un array con todos los generos. Cada posicion es un array asociativo con clave 'genero'
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
                <a href="index.php">Home</a>
                <?php
                    if(!isset($_SESSION['id_user'])){
                        echo "<a href=''>Registro</a>";
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
