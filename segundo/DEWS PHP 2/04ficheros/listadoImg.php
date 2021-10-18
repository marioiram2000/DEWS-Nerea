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
        $mostrarTabla = false;
        $errorCarpeta= "";
        $imagenes = [];
        
        if(isset($_GET['borrar'])){
            $ruta=$_GET['borrar'];
            unlink($ruta);
        }
        
        if(isset($_POST['submit']) || isset($_REQUEST['borrar']) || isset($_REQUEST['ver'])){
            $carpeta = $_REQUEST['carpeta'];
            if(!is_dir($carpeta)){
                $errorCarpeta = "Carpeta no encontrada";
            }else{
                
                $dir = opendir($carpeta);
                while($entrada = readdir($dir)){
                    //echo $entrada."<br>";
                    $partes= explode('.', $entrada);
                    $ext = $partes[count($partes)-1];
                    if($ext=="jpg"){
                        $imagenes[] = $_REQUEST['carpeta']."/".$entrada;
                    }
                }
                closedir($dir);
                if(count($imagenes)> 0){
                    $mostrarTabla = true;
                }else{
                    echo "array vacio..............................";
                }
            }
        }
        
        
        ?>
        
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
            <input type="text" name="carpeta"/><label for="carpeta">Nombre de la carpeta</label>
            <input type="submit" name="submit" value="Ver imagenes"/>                
        </form>
        <table>
        <?php
        if($mostrarTabla){
            //print_r($imagenes);
            foreach ($imagenes as $imagen) {
                $enlace = $_SERVER['PHP_SELF'];
                
                echo "<tr>";
                    //echo "<td><img src='$imagen' width='300'/></td>";
                    echo "<td>$imagen</td>";
                    echo "<td><a href='$enlace?ver=$imagen&carpeta=$carpeta'>VER</a></td>";      
                    if(isset($_GET['ver'])&&$_GET['ver']==$imagen){
                        echo "<td><img src='$imagen' width='300'/></td>";     
                    }
                    echo "<td><a href='$enlace?borrar=$imagen&carpeta=$carpeta'>BORRAR</a></td>";                
                echo "</tr>";
            }
        }
        ?>
        </table>
    </body>
</html>
