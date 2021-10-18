<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
        function rutasImag($carpeta){
            $extensiones = array("jpg", "png", "tiff");
            $d = opendir($carpeta);
            $imagenes = [];
            while(($entrada= readdir())!=false){                
                $partes = explode(".", $entrada);
                if(in_array($partes[1], $extensiones)){         
                    $imagenes[] = $entrada;
                }
            }
            return $imagenes;
        }
        
        function sacarImags($imagenes, $cant){
            $aux = [];
            $cont = 0;
            while($cont != $cant){
                $iImg = array_rand($imagenes);
                
                if(!in_array($imagenes[$iImg], $aux)){
                    $aux[] = $imagenes[$iImg];
                    $cont ++;
                }             
            }
            return $aux;
        }
        ?>
    </head>
    <body>
        <?php
        if(!isset($_POST['ver']) && !isset($_POST['submit'])){
            header("Location:ej2Selec_cantidad.php");
        }
        
        
        $n = $_POST['n'];
        $DIR_IMAG = "../imagenes";
        $rutas = rutasImag($DIR_IMAG);
        $imagenes = sacarImags($rutas, $n);
        
        if(isset($_POST['submit'])){
            if(count($_POST['imagenes'])>0){                
                echo "Gracias por seleccionar sus imagenes";          
                $f = fopen("../imagenes.txt", "a");
                $str = $_SERVER['REMOTE_ADDR'];
                foreach ($_POST['imagenes'] as $img) {
                    $str.= "\t".$img;
                }
                $str .= "\n";
                fwrite($f, $str);
                fclose($f);
            }else{
                echo "SENTIMOS QUE NO LE HAYA GUSTADO NINGUNA";
            }
        }else{
            echo '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
            for ($i = 0; $i < $n; $i++) {

                echo "<label for='$imagenes[$i]'><img src='$DIR_IMAG/$imagenes[$i]' alt='$imagenes[$i]' width='300'></label>";
                echo "<input type='checkbox' name='imagenes[]' value='$imagenes[$i]'>";
                echo "<input type='hidden' value='$n' name='n'>";
                echo "Me gusta <br>";

            }
            echo "<input type='submit' name='submit' value='ENVIAR VALORACIONES'>";
            echo "</form>";
        }
        


        
        
        
        ?>
    </body>
</html>
