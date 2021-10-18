
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
            $carpeta = "imagenes";
            
            function cuantasImg($carpeta) {
                $arrext = array("jpg","png","gif","tiff");
                $directorio = opendir($carpeta);
                $cont = 0;
                while ($archivo = readdir($directorio)){
                    $aux = explode(".", $archivo);
                    $extension = $aux[1];
                    if(in_array($extension, $arrext)){
                        $cont ++;
                    }
                }
                return $cont;
            }
        ?>
        <form action="ej2eval_imag.php" method="POST">
            <p>¿Cuantas imagenes quieres ver?
            <select name="cantidadFotos">
                <?php
                    $cantidad = cuantasImg($carpeta);
                    for ($index = 2; $index <= $cantidad; $index++) {
                        echo "<option value='$index'>".$index;
                    }
                ?>
            </select></p>
            <input type="hidden" name="cantidad" value="<?php echo $cantidad?>">
            <p><input type="submit" value="VER IMAGENES" name="submit"></p>
            
        </form>
    </body>
</html>
