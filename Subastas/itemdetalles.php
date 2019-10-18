<?php 
include './cabecera.php';
include './barra.php';
$id_item = $_GET['item'];
$pujas = $_GET['pujas'];
$pujaMasAlta = $_GET['pujaMasAlta'];
$info = sacarInfo($cn, $id_item);
$nombre = $info->nombre;
$descripcion = $info->descripcion;
$fechaFin = $info->fechafin;
$imagenes = sacarImagenes($cn, $id_item);
$_SESSION['actual']="http://localhost/Subastas/itemdetalles.php?item=$id_item&pujas=$pujas&pujaMasAlta=$pujaMasAlta";
$actual = $_SESSION['actual'];
$mensajeErrorPuja="";
if(isset($_SESSION['id_user'])){
    $id_user = $_SESSION['id_user'];
    $username = $_SESSION['username'];
}

$historial = "<h1>Historial de la puja</h1>";

$pujasAlArticulo = sacarPujasID($cn, $id_item);
foreach ($pujasAlArticulo as $puja) {
    $usuarioPujador = sacarUsername($cn, $puja->id_user);
    echo("----------------------------------------------------|id_user: $puja->id_user |------|usuario: $usuarioPujador---------------");
    $historial .= "<li>$usuarioPujador - $puja->cantidad €</li>";
}

//DESPUES DE PULSAR EL BOTON DE ENVIAR LA PUJA
if(isset($_POST['submit'])){
    $pujado = $_POST['puja'];
    if(!is_numeric($pujado)){
        $mensajeErrorPuja = "<p style='color:red'>El valor introducido debe ser numerico</p>";
    }else{
        if($pujaMasAlta>$pujado){
            $mensajeErrorPuja = "<p style='color:red'>La puja debe superar a la puja más alta</p>";
        }
    }
    
    if($mensajeErrorPuja==""){
        $resul = introducirPuja($cn, $id_item, $id_user, $pujado);
        $pujaMasAlta = $pujado;
        if(!$resul){
            echo "<p style='color:red'>Algo no ha salido como esperabamos, la puja no se ha podido introducir</p>";
        }else{
            $historial .= "<li>$usuarioPujador - $pujado €</li>";
        }
        
    }
}


echo "<h1>$nombre</h1>";
echo "<h3><strong>Número de pujas:</strong> $pujas - "
        . "<strong>Precio actual:</strong> $pujaMasAlta -"
        . " <strong>Fecha limite para pujar:</strong> $fechaFin</h3>";

foreach ($imagenes as $imagen) {
    echo "<img src='$imagen' alt='Imagen del articulo' width='300'/>";
}
echo "<h3>$descripcion</h3>";
echo "<h1>Puja por ese item</h1>";

if(!isset($_SESSION['id_user'])){
    echo "Para pujar, debes autenticarte: <a href='login.php'>Login</a>";
}else{
echo "<h3>Añade tu puja en el cuadro inferior:</h3>";
echo $mensajeErrorPuja;

echo "<form method='POST' action='$actual'>";
    echo '<input type="text" name="puja">';
    echo '<input type="submit" name="submit" value="Enviar">';
echo "</form>";

echo $historial;
}







            
include './pie.php';?>