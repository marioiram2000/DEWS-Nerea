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
            if(isset($_POST['submit_file'])){
                //$_FILES['fich']['name'] -->nombre del archivo en el cliente
                //$_FILES['fich']['type'] -->tipo del archivo p.e."image/gif"
                //$_FILES['fich']['size'] -->tamaño del archivo en bytes
                //$_FILES['fich']['tmp_name'] -->El archivo subido al servidor (una copia temporal con nombre aleatorio del original)
                
                if(is_uploaded_file($_FILES['fich']['tmp_name'])){
                    //$nombre="img/".$nombre="img/";//ponerle el nombre de la imgaen en el cliente
                    $destino="img/".$_POST['nombre'];
                    move_uploaded_file($_FILES['fich']['tmp_name'], $destino);
                    echo "<p>Archivo subido</p>";
                }else{
                    echo "<p>Archivo NO subido</p>";
                }
                
            }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <p>Nombre: <input type="text" name="nombre"/></p>
            <p>Fichero: <input type="file" name="fich"/></p>
            <p><input type="submit" name="submit_file" value="Subir imagen"></p>
        </form>
    </body>
</html>
