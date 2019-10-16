<?php 
include './cabecera.php';
include './barra.php';

$error = "";
if(isset($_POST['submit'])){
    $usu = $_POST['usuario'];
    $ps1 = $_POST['password1'];
    $ps2 = $_POST['password2'];
    $email = $_POST['correo'];
    
    $error = comprobarUsu($cn, $usu, $ps1, $ps2, $email);

}
?>
<h1>REGISTRO</h1>
<p> Para registrarse en SUBASTAS CIUDAD JARDIN, rellene el siguente formulario </p>
<form name="registro" method="POST" action="registro.php">
    <?php echo $error;?>
    <table border="1">
            <tr>
                <td>USUARIO</td>
                <td><input type="text" name="usuario"></td>
            </tr>
            <tr>
                <td>CONTRASEÑA</td>
                <td><input type="password" name="password1"></td>
            </tr>
            <tr>
                <td>REPITE LA CONTRASEÑA</td>
                <td><input type="password" name="password2"></td>
            </tr>
            <tr>
                <td>CORREO</td>
                <td><input type="text" name="correo"></td>
            </tr>
    </table>
    <input type="submit" name="submit" value="Registrarse">

</form>




            
<?php include './pie.php';?>
