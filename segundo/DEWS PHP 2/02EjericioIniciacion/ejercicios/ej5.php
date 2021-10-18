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
            function peliPreferiaDe($usuarios, $peli) {
                $nombres = array();
                $cont = 0;
                foreach ($usuarios as $nombre => $peliculas) {
                    if(in_array($peli, $peliculas)){
                        $cont ++;
                    }
                }
                return $cont;
            }
        
        
            $usuarios = array("Mario"=>array("El juego de ender", "Zootropia", "AliG"),
                              "Salama"=>array("Crepusculo", "Frozen 2", "Apu Sansar", "Crepusculo"),
                              "Gumer"=>array("Soar Into the Sun", "Mulan"),
                              "Mark"=>array("Guayaquil de mis amores", "Los hieleros del Chimborazo", "El tesoro de Atahualpa", "Crepusculo"),
                              "Jongo"=>array("AliG", "Cars", "Crepusculo")
                );
            
            echo "<p>Crepusculo es la peli preferida de ".peliPreferiaDe($usuarios, "Crepusculo")." personas</p>";
            echo "<p>AliG es la peli preferida de ".peliPreferiaDe($usuarios, "AliG")." personas</p>";
            echo "<p>AliG es la peli preferida de ".peliPreferiaDe($usuarios, "Mulan")." personas</p>";
            
        ?>
    </body>
</html>
