<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    session_start();
    if(!isset($_SESSION['nombreCompleto'])){
        header("Location: nombre.php");
    }
    $nombreCompleto = $_SESSION['nombreCompleto'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <form method="post" action="final.php">
            <p>Su nombre y apellidos son: <?php echo $nombreCompleto;?></p>
            <p>Es correcto? <input type="submit" name="si" value="Sí"><input type="submit" name="no" value="No"></p>
        </form>
    </body>
</html>
