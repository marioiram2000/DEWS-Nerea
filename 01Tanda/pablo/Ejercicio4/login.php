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
            $usuario="";
            $error="";
            if (isset($_GET['nombre']))
            {
                $usuario=$_GET['nombre'];
            }
            
            if (isset($_GET['error']))
            {
                if($_GET['error']=='err_type1')
                    $error="<p>CONTRASEÑA ERRONEA PARA <b>".$_GET['nombre']."</b><br>Intentalo de nuevo</p>";
            }
        ?>
        
        <?php echo $error?>
        <form method="POST" action="validacion.php">
            <table>
                <tr>
                    <td>Nombre de usuario: </td>
                    <td><input type="text" name="username" value="<?php echo $usuario ?>"/></td>
                    <td rowspan="2"><input type="submit" name="submit_login" value="ENTRAR"/></td>
                </tr>
                <tr>
                    <td>Contraseña: </td>
                    <td><input type="password" name="pass" value=""/></td>
                </tr>
            </table>
        </form>
    </body>
</html>
