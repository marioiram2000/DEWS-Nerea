<?php
    require 'bbdd.php';
    $con = conexion();
    session_start();
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $error = "";
        
        if(isset($_POST['submitregistrar'])){
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            if(registrar($con,$dni,$nombre)){
                $_SESSION['idcliente'] = $dni;
                $_SESSION['nombre'] = $nombre;
                header("Location:pedido.php");
                exit();
            }else{
                $error = "DNI duplicado";
            }
            
        }
        
        
        echo "<p style='color:red;'>$error</p>";
        ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
            <label>DNI</label><input type="text" name="dni">
            <label>Nombre</label><input type="text" name="nombre">
            <input type="submit" name="submitregistrar" value="registrar">
        </form>
    </body>
</html>
