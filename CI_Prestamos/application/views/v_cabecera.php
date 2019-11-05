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
            <h1>PRESTAMOS</h1>            
        </div>
        <div id="container">
            <div id="bar">
                <p>GENEROS:</p>
                <ul>
                    <?php
                    foreach ($todosGeneros as $genero) {
                        $g = $genero['genero'];
                        $enlace = site_url()."/c_prestamos/clasificar/$g";
                        echo "<li><a href='$enlace'> $g </a></li>";
                    }
                    ?>
                </ul>
            </div>
