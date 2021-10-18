<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            if(isset($_GET['nombre']) && isset($_GET['edad'])){
                echo "<p>Nombre: ".$_GET['nombre']." edad: ".$_GET['edad'];
            }else{
                //echo "<p>Debes incluir parametros get</p>";
                $enlace = $_SERVER['PHP_SELF']."?nombre=desconocido&edad=desconocido";
                echo "<a href='$enlace'>Pincha aquí</a>";
            }
        ?>
    </body>
</html>
