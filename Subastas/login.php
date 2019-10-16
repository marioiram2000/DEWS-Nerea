<?php 
include './cabecera.php';
include './barra.php';
?>
<h1>LOGIN</h1>

<form name="login" method="POST" action="">
    <table border="1">
            <tr>
                <td>USUARIO</td>
                <td><input type="text" name="usuario"></td>
            </tr>
            <tr>
                <td>CONTRASEÑA</td>
                <td><input type="text" name="password1"></td>
            </tr>
    </table>
    <input type="submit" name="submit" value="Iniciar sesión">
</form>
<h3>No tienes una cuenta? <a href="registro.php">Regístrate!</a></h3>



            
<?php include './pie.php';?>
