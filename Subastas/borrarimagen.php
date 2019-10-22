<?php
include './cabecera.php';

$imagen = $_GET['id_imagen'];
if($imagen==""){
    header("Location: http://localhost/Subastas/index.php");
}
?>

<h1>¿Borrar imagen?</h1>
<p>¿Relamente quieres borrar esta imagen?</p>
<p></p>



<?php include './pie.php';?>