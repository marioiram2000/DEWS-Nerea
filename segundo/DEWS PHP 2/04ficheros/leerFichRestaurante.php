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
            $f = fopen("ficheros/restaurante.txt", "r+");
            if(!$f){
                echo '<p>no existe el fichero</p>';
                exit();
            }
            //Formato %s -> cadena, %d -> entero, %f -> float
            $partes = fscanf($f, "%s\t%d\t%f");
            $cont = 0;
            $suma = 0;
            
            while(!feof($f)){
                list($nombre,$cal,$precio)=$partes;
                
                $suma += $precio;
                $cont ++;
                
                echo '<p>';
                echo $nombre." ".$cal." ".$precio;
                echo '</p>';
                $partes=fscanf($f, "%s\t%d\t%f");
            }
            
            $media = $suma/$cont;
            //fputs($f, "PRecio medio:".$media."\r\n");            
            
            fclose($f);
        ?>
    </body>
</html>
