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
            $c = "hola que tal";
            echo "<p>".strtoupper($c)."</p><br>";
            $a = explode(" ", $c);
            foreach ($a as $pal) {
                echo "<p>".$pal."</p>";
            }
            
            echo "<br><p>cadena invertida</p>";
            $invert = strrev($c);
            echo "<p>$invert</p>";
            
        
        ?>
    </body>
</html>
