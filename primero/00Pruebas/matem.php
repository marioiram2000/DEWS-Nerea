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
            $x=10;
            $y=5;
            $multi= $x * $y;
        ?>
        <p>Multiplicando...</p>
        
        <?php
            echo "<p><u>". $multi ."</u></p>";
            echo "<p><u>$multi</u></p>"
        ?>
        
        <p>Raiz cuadrada de 10</p>
        
        <?php
            echo "<p><b>". number_format(sqrt($x), 2) ."</b></p>";
        ?>
        
        <p>Factorial de 10</p>
        
        <?php
            $fact=1;
            for ($cont=1; $cont<=$x; $cont++){
                $fact*=$cont;
            }
            echo "<p><u><b>$fact</b></u></p>";
        ?>
        
        
    </body>
</html>
