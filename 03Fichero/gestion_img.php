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
        $extension = "";
        $carpeta = "";
        //Sacar los tipos de archivo que hay en la carpeta
        function sacarExtensiones() {
            $directorio = opendir("imagenes"); //ruta 
            $tipos = [];
            while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
            {
                $aux = explode(".", $archivo);
                $extension = $aux[1];
                if(!in_array($extension, $tipos)){
                    $tipos[] = $extension;
                }
            }
            closedir($directorio);
            return $tipos;
        } 
        //sacar los archivos de la carpeta con una extension determinada
        function sacarArchivos($ext) {
            
            $directorio = opendir("./imagenes");
            $archivos = [];
            while ($archivo = readdir($directorio)){
                $aux = explode(".", $archivo);
                $nom = $aux[0];
                $extension = $aux[1];
                if($extension==$ext){
                    $archivos[$nom] = "./imagenes/".$archivo;
                }
            }            
            closedir($directorio);
            return $archivos;
        }
        
        //Cambiar el nombre de la imagen   
        $archivos=array();
        if(isset($_POST['cambiar'])){
            
         //   $archivos = sacarArchivos($extension);
            $nombreAnterior = $_POST['nombreConRuta'];
            $nuevoNombre = $_POST['nuevoNombre'];
            $carpeta = "imagenes/";
            $ext = pathinfo($nombreAnterior, PATHINFO_EXTENSION);
             
            
            $aux = $carpeta.$nuevoNombre.".".$ext;
            //echo $aux;
            //exit();
            //rename($oldname, $newname);
            rename($nombreAnterior, $aux);
        }
        
        
        
        if(isset($_POST['submit'])){
              //guardo la extension deseada para que se quede puesta despues de pulsar el ver
              $extension = $_POST['extensiones'];
              $archivos = sacarArchivos($extension);
              
        }
        ?>
  
        
        <!--Empiezo con la parte de arriba de elegir la extension -->
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            
            <p>Elige la extensión 
                <select name="extensiones">
                <?php 
                    $ext = sacarExtensiones();
                    foreach ($ext as $value) {
                        if($extension==$value){
                            echo "<option value='".$value."' selected>".$value."</option>";
                            
                        }else{
                            echo "<option value='".$value."'>".$value."</option>"; 
                        }
                    }
                ?>
                </select>
                <input type='hidden' name='ext' value='$ext'>
                <input type="submit" name="submit" value="VER">
            </p>
        </form>
        
        
        <?php
        
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<th>Nombre</th>";
                    echo "<th>Imagen</th>";
                    echo "<th>Nuevo nombre</th>";
                    echo "<th></th>";
                echo "</tr>";

                foreach ($archivos as $nombre => $imagen) {

                    $PHP_SELF = "PHP_SELF";
                    $ext = $_POST['ext'];
                    echo "<form action='$_SERVER[$PHP_SELF]' method='POST'>";
                        echo "<input type='hidden' name='nombreConRuta' value='$imagen'>";
                        echo '<input type="hidden" name="carpeta" value="./imagenes/">';
                        echo "<tr>";
                           echo "<td>".$nombre."</td>";
                           echo "<td><img src='".$imagen."'width='40'></td>";
                           $ruta = $imagen;
                           echo "<td><input type='text' name='nuevoNombre'></td>";
                           echo "<td><input type='submit' name='cambiar' value='CAMBIAR' ></td>";
                        echo "</tr>";
                    echo "</form>";
                }
            echo "</table>";
        
        ?>   
        
        
    </body>
</html>

