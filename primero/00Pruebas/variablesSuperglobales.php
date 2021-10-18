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
            echo "Guion actual". $_SERVER["PHP_SELF"];
            echo "<br>";
            echo "Dir Ip cliente" . $_SERVER["REMOTE_ADDR"];
            echo "<br>";
            if(isset($_GET['nombre'])){
                echo "nombre enviado por GET". $_GET['nombre'];
            }else{
                echo "no se ha enviado variable de nombre";
            }
            
        ?>
    </body>
</html>
