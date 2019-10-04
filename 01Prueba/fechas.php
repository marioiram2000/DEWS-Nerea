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
        date_default_timezone_set("Europe/Madrid");
        
        echo "<p>fecha actual: ".date("d-F-Y")."</p>";
            
            //Días transcurridos entre el 1 de enero de 2019 y hoy
            $tactual = time();
            $tanterior = strtotime("2019/01/01");
            echo "<p>dias transcurridos: ". (int)(($tactual-$tanterior)/(60*60*24))."</p>";
            
            //t hace 10 mins
            $tactual = time();
            $thace10 = $tactual -(10*60);
            echo "<p>hace 10 mins eran las ". date("h:i",$thace10)."</p>";
            
            //minutos que faltan para ir a casa
            $tactual = time();
            $hsalida = strtotime("14:30");
            echo "<p>salimos en ". ($hsalida-$tactual)/(60)." minutos o en ".($hsalida-$tactual)/(60*60)." horas</p>";
       
            //que dia de la semana era el día que naciste
            
            $dnac = strtotime("17/08/2000", time());
            echo "<p> nací un ". date("I",$dnac)."</p>";
            
            ?>
    </body>
</html>
