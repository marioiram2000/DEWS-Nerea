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
            if (isset($_POST['submit'])){
                echo "Nombre: ". $_POST['nombre'];
                echo"<br>";
                if(isset($_POST['sexo'])){
                    echo "Sexo: ". $_POST['sexo'];
                    echo"<br>";
                }else{
                    echo "no tienes sexo";
                    echo"<br>";
                }
            }else{
                header('location: index.php');
            }
        ?>
    </body>
</html>
