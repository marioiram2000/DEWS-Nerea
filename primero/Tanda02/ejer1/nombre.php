<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    session_start();
    if(isset($_POST['seguir'])){
        $str = $_POST['nombre'];
            $_SESSION['nombre']=$str;
            header("Location: apellido.php");
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <p>Escriba su nombre:</p>
            <p>Nombre: <input type="text" name="nombre"></p>
            <input type="submit" name="seguir" value="Seguir">
            <!--<input type="reset" name="borrar" value="Borrar">-->
        </form>
    </body>
</html>
