<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    session_start();
    if(!isset($_SESSION['nombre'])){
        header("Location: nombre.php"); 
    }
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
    $nom = $_SESSION['nombre'];
    $correcto=true;
    if(isset($_POST['seguir2'])){
        $ap = $_POST['apellidos'];
        $nombreCompleto = $nom." ".$ap;
        $correcto = evaluarStr($nombreCompleto);
        if($correcto){
            $_SESSION['nombreCompleto'] = $nombreCompleto;
            header("Location: confirmacion.php");
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php if($correcto){ ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <p>Su nombre es <?php echo $nom?></p>
            <p>Escriba sus apellidos</p>
            <p>Apellidos: <input type="text" name="apellidos"></p>
            <input type="submit" name="seguir2" value="Seguir">
            <!--<input type="reset" name="borrar2" value="Borrar">-->
        </form>
        <?php
        }else{
            echo "Datos incorrectos <a href='nombre.php'>Volver</a>";
        } 
        
        ?>
    </body>
</html>
