<?php
include './includes/cabecera.php';
session_start();
$id_ruta=$_GET['id_ruta'];
$cantidad=$_GET['cantidad'];

$precio = sacarprecio($cn, $id_ruta);
$preciofinal = intval($precio)*intval($cantidad);

foreach ($_SESSION['seleccionados'] as $value) {
    if($value!=null){
        reservar($cn,$value);
    }
}
echo "<p>Precio final:$cantidad x $precio = $preciofinal</p>";
echo "<a href='index.php'>VOLVER</a>";