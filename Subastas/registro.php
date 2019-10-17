<?php 
include './cabecera.php';
include './barra.php';

$usu = "";
$ps1 = "";
$ps2 = "";
$email = "";
$error = "";
if(isset($_POST['submit'])){
    $usu = $_POST['usuario'];
    $ps1 = $_POST['password1'];
    $ps2 = $_POST['password2'];
    $email = $_POST['correo'];
    
    $error = comprobarUsu($cn, $usu, $ps1, $ps2, $email);
    if ($error == ""){
        $str = insertarUsuario($cn, $usu, $ps1, $email);
        if($str != false){
            enviarCorreo($str, $email, $usu);
        }else{
           echo "<p style='color:red'>Ha ocurrido algún imprevisto.</p> ";
        }
    }
}
?>
<h1>REGISTRO</h1>
<p> Para registrarse en SUBASTAS CIUDAD JARDIN, rellene el siguente formulario </p>
<form name="registro" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php echo $error;?>
    <table border="1">
            <tr>
                <td>USUARIO</td>
                <td><input type="text" name="usuario" value="<?php echo $usu?>"></td>
            </tr>
            <tr>
                <td>CONTRASEÑA</td>
                <td><input type="password" name="password1" value="<?php echo $ps1?>"></td>
            </tr>
            <tr>
                <td>REPITE LA CONTRASEÑA</td>
                <td><input type="password" name="password2" value="<?php echo $ps2?>"></td>
            </tr>
            <tr>
                <td>CORREO</td>
                <td><input type="text" name="correo" value="<?php echo $email?>"></td>
            </tr>
    </table>
    <input type="submit" name="submit" value="Registrarse">

</form>




            
<?php include './pie.php';?>
