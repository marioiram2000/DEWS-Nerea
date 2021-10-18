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
            if(isset($_POST['submit'])){
                header("Location:index.php");
            }else{                
                $nom = $_POST['nom'];
                $pas = $_POST['password'];
                $i = $_POST['edad'];
                
                if(!isset($_POST['sexo'])){
                    $errores[] = "Se debe seleccionar un sexo";
                }else{
                    $sexo = $_POST['sexo'];
                }
                
                if(!isset($_POST['aficiones'])){
                    $errores[] = "Se debe seleccionar alguna aficion";
                }else{
                    $aficiones = $_POST['aficiones'];
                }
                
                if(isset($errores)){
                    foreach ($errores as $errore) {
                        echo "<p>$error</p>";
                    }
                }else{
                    echo "<p>Nombre: $nom</p>";
                    echo "<p>Contraseña: $pas</p>";
                    echo "<p>Edad: $i</p>";
                    $sexoTodo = ($sexo=='h')?'Hombre':'Mujer';
                    echo "<p>".$sexoTodo."</p>";
                    echo "<p>Aficiones</p>";
                    foreach ($aficiones as $aficion) {
                        echo "<p>$aficion</p>";
                    }
                }
            }
        ?>
    </body>
</html>
