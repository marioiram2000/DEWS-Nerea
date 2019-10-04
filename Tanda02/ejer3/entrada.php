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
        <?php
        /*
            if(isset($_POST['submitInvitado']) || isset($_POST['submitSocio'])){
                //echo "entra";
                $_SESSION['usuario'] = $_POST['usuario'];
                $_SESSION['password'] = $_POST['password'];
                if(isset($_POST['submitSocio'])){
                    echo "socio";
                    $_SESSION['invitado']= false;
                    header("autenticacion.php");
                }
                if(isset($_POST['submitInvitado'])){
                    echo "invitado";
                    $_SESSION['invitado']= true;
                    header("autenticacion.php");
                }
            }
         * 
         */
        ?>
    </head>
    <body>
        <form method="POST" action="autenticacion.php">
            <table border="1">
                <tr><td>
                    <?php 
                        if(isset($_GET['error'])){
                            echo 'Login incorrecto';
                        }
                    ?>
                    <p>Si eres SOCIO, introduce tu usuario y contraseña</p>
                    <p>USUARIO: <input type="text" name="usuario"></p>
                    <p>CONTRASEÑA: <input type="password" name="password"</p>
                    <p><input type="submit" name="submitSocio" value="Acceso Socio"</p>
                </td></tr>
                <tr><td>
                    <p>Si no dispones de usuario, entra como invitado</p>
                    <p>Acceso Invitado</p>
                    <p><input type="submit" name="submitInvitado" value="Acceso Invitado"</p>
                </td></tr>
            </table>      
        </form>
    </body>
</html>
