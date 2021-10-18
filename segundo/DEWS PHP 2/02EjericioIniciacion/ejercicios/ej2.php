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
        
            $temps = array("L"=>30, "M"=>29, "X"=> 32, "J"=> 30, "V"=>34, "S"=> 35, "D"=>33);
            echo "<p>Temperaturas de la semana</p><ul>";
            foreach ($temps as $d => $t) {
                echo "<li>$d: $t ºC</li>";
            }
            echo "</ul>";
            $media = array_sum($temps)/count($temps);
            echo "<p>La media de la semana es de ".$media." ºC</p>";
            echo "<p>Al redondearla se queda en ". round($media)." ºC</p>";
            echo "<p>Y al truncarla en ".(int)$media." ºC</p>";
            
            sort($temps);
            for ($i = 0; $i < 3; $i++) {
                echo $temps[$i]."\t";
            }
            echo "<br>";
            $aux = array_reverse($temps);
            for ($i = 0; $i < 3; $i++) {
                echo $aux[$i]."\t";
            }
        ?>
    </body>
</html>
