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
            //Tras el submit
            function rellenarArchivo() {
                if(isset($_POST['enviar'])){
                    $gustadas = $_POST['gustadas'];
                    if(!count($gustadas)==0){
                        $f=fopen("favoritas.txt",'a');
                        fputs($f,"Direccion ip:".$_SERVER['REMOTE_ADDR']."\n");
                        for ($i=0;$i<count($gustadas);$i++)
                        {
                            fputs($f,"Foto ".($i+1).$gustadas[$i]."\t");
                        }
                        fputs($f,"\n");
                        fclose($f);
                        return true;
                    }
                    return false;
                }
            }
        
         if(!isset($_POST['enviar'])){ 
            $cantidad = $_POST['cantidadFotos'];
            //echo $cantidad;
            $carpeta = "imagenes";
            function rutas_imag($carpeta) {
                $arrext = array("jpg","png","gif","tiff");
                $directorio = opendir($carpeta);
                $archivos = [];
                while ($archivo = readdir($directorio)){
                //guardo todos los archivos en un array
                    $aux = explode(".", $archivo);
                        $extension = $aux[1];
                        if(in_array($extension, $arrext)){
                             $archivos[] = $archivo;
                             //echo $archivo;                              
                        }               
                }
                return $archivos;
            }
            $rutas = rutas_imag($carpeta);
            $posiciones = array_rand($rutas, $cantidad);//la funcion devuelve claves aleatorias, no valores aleatorios
            $imagenes = [];
            foreach ($posiciones as $posicion) {
                $imagenes[] = $rutas[$posicion];
            }
            print_r($imagenes);




       
        ?>
        <table>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <input type="hidden" name="gustadas" value="<?php$_POST['meGusta']?>">                     
                <?php 
                    foreach ($imagenes as $imagen) {
                        echo "<tr>";
                            echo "<td><img src='./imagenes/".$imagen."'height='60'></td>";
                            echo "<td><input type='checkbox' name='meGusta' value='$imagen'>Me gusta</td>";
                        echo "</tr>";
                    }
                ?>
                <tr><td><input type="submit" value="ENVIAR VALORACIONES" name="enviar"></td></tr>
            </form>
        </table>
        <?php
        }else{
            if(isset($_POST['enviar'])){
                if(rellenarArchivo())
                   echo "Gracias por tu envío";
                else
                   echo 'Sentimos que no le haya gustado ninguna';
               
                echo '<a href="ej2selec_cantidad.php">Volver al inicio</a>';  
            }
        }
        ?> 
    </body>
</html>


