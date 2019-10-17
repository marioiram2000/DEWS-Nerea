<?php 
include './cabecera.php';
include './barra.php';

$str = $_GET['cadena'];
$verificado = verificarUsuario($cn, $str);
if($verificado){
    echo "<p style='color:green'>Se ha verificado su cuenta. Puedes entrar pinchando log in.</p> ";
    echo "<h3>Para hacer el login pinche <a href='http://localhost/Subastas/login.php'>aquí</a></h3>";
}else{
    echo "<p style='color:red'>No se ha podidio verificar su cuenta. Sentimos las molestias</p> ";
}
?>
            
<?php include './pie.php';?>

