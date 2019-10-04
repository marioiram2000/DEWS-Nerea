<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    if(isset($_GET['cerrar'])){//Para que pueda seguir, despues de destruir la sesion, creo una nueva
        session_destroy();
        session_start();
        //header("index.php");
    }
    
    $correcto=true;
    function evaluarStr($str) {
        $numeros = ["1","2","3","4","5","6","7","8","9","0"];
        for ($i = 0; $i < strlen($str); $i++) {
            if(in_array($str[$i], $numeros)){
                return false;
            }
        }
        if($str==""){
            return false;
        }
        return true;
    }   
    if(isset($_POST['aniadir'])){
        $nombre = $_POST['nombre'];
        //echo $nombre;
        $correcto= evaluarStr($nombre);
        if($correcto){
            if(!isset($_SESSION['nombres'])){//Siempre se tiene que añadir el nombre, da igual si es la primera vez que si no
                $_SESSION['nombres'] = array();
            }
            $_SESSION['nombres'][]=$nombre;
            
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php 
            if(!$correcto)
                echo "No has escrito el nombre únicamente con letras y espacios";
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <p><strong>Escriba algún</strong></p>
            <p><strong>nombre: </strong><input type="text" name="nombre"></p>
            <input type="submit" name="aniadir" value="Añadir">
            <!--<input type="reset" name="borrar" value="Borrar">-->
        </form>
        <?php
            if(isset($_SESSION['nombres'])){
               echo "Datos introducidos:";
               echo "<ul>";
                    $nombres =$_SESSION['nombres'];
                    foreach ($nombres as $nombre) {
                         echo "<li>".$nombre."</li>";
                    }
               echo "</li>";
            }else{
                echo "Todavia no has introducido nombres.";
            }
        ?>
        <br>
        <a href="index.php?cerrar">Cerrar sesión (se perderán los datos almacenados)</a>
    </body>
</html>
