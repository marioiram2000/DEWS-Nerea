<?php 
include './cabecera.php';
include './barra.php';

$usu = "";
$ps = "";

if(isset($_POST['submit'])){
    $usu = $_POST['usuario'];
    $ps = $_POST['password'];
    $resultado = verificarUsu($cn, $usu, $ps);
    if($resultado != "verificado"){
        if($resultado == "usuario"){
            echo "<p style='color:red'>Ese usuario no existe</p>";
        }
        if($resultado == "clave"){
            echo "<p style='color:red'>Contraseña incorrecta</p>";
        }
        if($resultado == "verificar"){
            echo "<p style='color:red'>Esta cuenta no está verificada. Le hemos enviado un correo para verificarla</p>";
        }
    }else{
        $_SESSION['id']= sacarId($cn, $usu);
        $_SESSION['usuario']=$usu;
        $anterior = $_SESSION['actual'];
        header("Location:$anterior");
    }
    
}
?>
<h1>LOGIN</h1>

<form name="login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table border="1">
            <tr>
                <td>USUARIO</td>
                <td><input type="text" name="usuario" value="<?php echo $usu?>"></td>
            </tr>
            <tr>
                <td>CONTRASEÑA</td>
                <td><input type="text" name="password" value="<?php echo $ps?>"></td>
            </tr>
    </table>
    <input type="submit" name="submit" value="Iniciar sesión">
</form>
<h3>No tienes una cuenta? <a href="registro.php">Regístrate!</a></h3>



            
<?php include './pie.php';?>
