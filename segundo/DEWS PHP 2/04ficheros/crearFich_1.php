<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        function crearFicheroAlimentos($nomfich, $alimentos){
            $f = fopen("ficheros/".$nomfich, "w");
            
            if(!$f){
                return false;
            }
            
            foreach ($alimentos as $comida => $calorias) {
                //fputs($f, $comida."\t".$calorias.."\t".$precio"\r\n");
            }
            fclose($f);
            
            return true;
        }
        
        
        
        $alimentos = array(
            "patatas" => 450,
            "lentejas" => 400,
            "pizza" => 560
        );
        
        if(crearFicheroAlimentos("restaurante.txt", $alimentos)){
            echo "<p>Fichero creado</p>";
        }else{
            echo "<p>Fichero no creado</p>";
        }
        
        ?>
    </body>
</html>
