<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$usuario = "";
$error="";
if (isset($_GET['usuario'])){
    $usuario = $_GET['usuario'];
    $error = "CONTRASEÑA INCORRECTA";
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php echo $error;?>
        <form action="validacion.php" method="post">
            <h2>Nombre de usuario: <input type="text" name='usuario' value="<?php echo $usuario;?>"></h2>
            <h2>Contraseña: <input type="password" name='password'></h2>
            <input type="submit" value="ENTRAR" name="submit">
        </form>
        <p><a href="alta.php">No estoy registrado</a></p>
    </body>
</html>
