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
        function creaArrayCalorias($ruta){
            $f = fopen($ruta, "r");
            if($f==false){
                return false;
            }
            
            $alims=[];
            $linea = fgets($f);
            while(!feof($f)){
                $partes = explode("\t", $linea);
                $alimentos = $partes[0];
                $calorias = $partes[1];
                $alims[$alimentos] = $calorias;
                $linea = fgets($f);
            }
            return $alims;
            
        }
        
        $alimentos = creaArrayCalorias("ficheros/alimentos.txt");
        if($alimentos!=false){
            echo "<p>Array creado</p>";
            foreach ($alimentos as $alimento => $calorias) {
                echo $alimento." -> ".$calorias." calorias <br>";
            }
        }else{
            echo "<p>Array no creado</p>";
        }
        ?>
    </body>
</html>
