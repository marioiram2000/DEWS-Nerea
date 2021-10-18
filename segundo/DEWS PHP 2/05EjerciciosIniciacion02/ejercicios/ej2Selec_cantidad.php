<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        function cuantasImg($carpeta){
            $extensiones = array("jpg", "png", "tiff");
            $d = opendir($carpeta);
            $cont = 0;
            while(($entrada= readdir())!=false){
                
                $partes = explode(".", $entrada);
                if(in_array($partes[1], $extensiones)){         
                    
                    $cont ++;
                }
            }
            return $cont;
        }
        //define("DIR_IMAG", "../imagenes");
        //cuantasImg(Constants::DIR_IMAG);
        
        $DIR_IMAG = "../imagenes";
        $cant = cuantasImg($DIR_IMAG);
        ?>
        <form method="POST" action="ej2Eval_imag.php">
            <label for="n">¿Cuantas imagenes deseas ver?</label>
            <select name="n">
                <?php
                for ($i = 2; $i <= $cant; $i++) {
                    echo "<option value='$i'>$i</option>";
                }                
                ?>
            </select>
            <input type="submit" name="ver" value="VER IMAGENES">
        </form>
    </body>
</html>
