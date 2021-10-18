<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $nombre = "";
        $errorPas = "";
        if(isset($_POST['submit'])){
            $nombre = $_POST['nombre'];
        }
        if(isset($_GET['nombre'])){
            $nombre = $_GET['nombre'];
        }
        if(isset($_GET['pasIncorrecta'])){
            $errorPas = "Contraseña incorrecta";
        }


        ?>
        <form method="POST" action="ej4Validacion.php">
            <table>
                <tr><th colspan="2">LOGIN</th></tr>
                <tr>
                    <td><label for="nombre">Nombre de usuario:</label></td>
                    <td><input type="text" name="nombre" value="<?php echo $nombre?>"></td>
                </tr>
                <tr>
                    <td><label for="pas">Contraseña</label></td>
                    <td><input type="password" name="pas" value=""></td>
                </tr>
                <tr><td colspan="2"><input type="submit" name="submit" value="ENTRAR"></td></tr>
            </table>
        </form>
        <p><?php echo $errorPas;?></p>
    </body>
</html>

