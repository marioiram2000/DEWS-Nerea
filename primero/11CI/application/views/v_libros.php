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
        
        
        //Le llega $cant y $libros (array con objetos: titulo,paginas,idlibro)
            echo $cant . " libros<br/>";
            
            foreach ($libros as $libro){
                echo "<p>$libro->idlibro - $libro->titulo  - $libro->paginas</p>";
            }
        ?>
    </body>
</html>
