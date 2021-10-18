<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //Se crea una matriz en el servidor, $_FILES con una clave-valor por cada file subido
        //$_FILES['foto']['tmp_name']: archivo en el servidor
        //$_FILES['foto']['name']: nombre del archivo en el cliente
        //$_FILES['foto']['size']: tamaño del archivo en bytes
        //$_FILES['foto']['type']: es el tipo MIME del archivo P.E "image/gif
        //is_uploaded_file: ver si se ha podido subir
        //move_uploaded_file: retener/copiar el archivo en el servidor
        
        if(isset($_POST['submit'])){
            if(is_uploaded_file($_FILES['foto']['tmp_name'])){
                $origen = $_FILES['foto']['tmp_name'];
                $destino = "img/".$_POST['nombre'].".jpg";
                if(file_exists($destino)){
                    echo "<p>Ya hay una imagen con ese nombre en el servidor</p>";
                }else{
                    move_uploaded_file($origen, $destino);
                }
                
                
                echo "<img src='$destino' alt='no se ha podido ver'/>";
            }else{
                echo "<p>El tamaño máximo de la foto es ".$_POST['MAX_FILE_SIZE']."</p>";
            }
            
            
        }
        ?>
        
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
            <input type="text" name="nombre"/>
            <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
            <input type="file" name="foto"/>
            <input type="submit" name="submit" value="Submit"/>                
        </form>
    </body>
</html>
