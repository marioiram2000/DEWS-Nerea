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
            $handle = fopen("../direcciones.txt", "r");
            while(!feof($handle)){
                $linea = trim(fgets($handle));
                $linea = explode("___", $linea);
                echo "<a href='$linea[0]'>".$linea[1]."</a><br>";
            }
        ?>
    </body>
</html>
