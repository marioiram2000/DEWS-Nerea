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
        function crearFiltrado($rutaOrigen, $rutaDestino){
            $sust = array("\t"=>" ", "ñ"=>"gn", "<h2>" => "<h3>", "</h2>" => "</h3>");
            $fOrigen = fopen($rutaOrigen, "r");
            if(!$fOrigen)
                return false;
            $strOrigen = fread($fOrigen, filesize($rutaOrigen));
            fclose($fOrigen);
            
            foreach ($sust as $antes => $despues) {
                $strOrigen = str_replace($antes, $despues, $strOrigen);
            }
            
            $fDestino = fopen($rutaDestino, "w");
            fputs($fDestino,$strOrigen);
            
            fclose($fDestino);
            
            return true;
        }
        
        crearFiltrado("ficheros/origen.txt", "ficheros/destino.txt");
        ?>
    </body>
</html>
