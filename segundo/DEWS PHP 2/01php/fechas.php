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
        
        echo "Hoy es ". date("d, m, Y");
        
        $strcomienzo = "2020/03/09";
        $tC= strtotime($strcomienzo);
        $tA = time();
        
        $difDias=(int)($tA -$tC)/(60*60*24);
        
        
        $hace10 = $tA-(10*60);
        echo "<p>". date("H:i", $hace10)."</p>";
        
        echo "<h1>Minutos que faltan para ir a casa</h1>";
        $hSalida = strtotime("12:30");
        $minsRestantes = (int) (($hSalida - time())/60);
        echo "<p>". $minsRestantes ."</p>";
        ?>
    </body>
</html>
