<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $errorAutentica="";
        if(isset($_GET['errorAutentica'])){
            $errorAutentica = "Error de autenticacion";
        }
        echo "<p>$errorAutentica</p>";
        ?>
        <form method="POST" action="autenticacion.php">
            <p>Si eres SOCIO, introduce tu usuario y contraseña</p>
            <p>Usuario: <input type="text" name="usu"></p>
            <p>Contraseña: <input type="password" name="pas"></p>
            <p><input type="submit" value="Acceso socio" name="submitSocio"></p>
            <hr>
            <p>Si no dispones de usuario, entra como invitado</p>
            <p><input type="submit" value="Acceso invitado" name="submitInvitado"></p>
        </form>
    </body>
</html>
