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
        function mostrarFotos($rutas) {
            $cont = 0;
            foreach ($rutas as $ruta) {
                if($cont == 0){
                    echo "<tr>";
                }
                echo "<td><a href='$ruta'><img src = '$ruta' width='300'></a></td>";
                $cont ++;
                if($cont == 3){
                    echo "</tr>";
                    $cont = 0;
                }
            }
        }
        
        
        ?>
        <table border="solid">
            <?php 
            $rutas = array("../images/casuario.jpg", "../images/delfin.jpg", "../images/gato.jpg", "../images/kapibara.jpg", "../images/llama.jpg", "../images/ornitorrinco.jpg", "../images/kapibara.jpg");
            $rutas = array_unique($rutas);
            mostrarFotos($rutas);
            ?>
        </table>
    </body>
</html>
