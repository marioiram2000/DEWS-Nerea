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
        function mostrarTabla($hini, $hfin, $intervalo) {
            $semana = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado", "Domingo");
            echo "<table border='1'><tr><th></th>";
            foreach ($semana as $dia) {
                echo "<th>$dia</th>";
            }
            echo "</tr>";
            
            $h = $hini;
            $contFilas = 0;
            while ($h <= $hfin){
                if($contFilas%2!=0){
                    echo "<tr style='background-color: grey'><th>".date("H:i", $h)."</th><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                }else{
                    echo "<tr><th>".date("H:i", $h)."</th><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                }
                $contFilas ++;
                $h += ($intervalo*60);
            }
            //$hace10 = $tA-(10*60);
            
            echo "</table>";
        }
        
        mostrarTabla(strtotime("8:30"), strtotime("14:00"), 30);
        ?>
    
    </body>
</html>
