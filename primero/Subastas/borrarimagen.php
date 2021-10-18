<?php
include './cabecera.php';

$imagen = $_GET['id_imagen'];
if($imagen==""){
    header("Location: http://localhost/Subastas/index.php");
}
$anterior = $_SESSION['actual'];
if(isset($_POST['si'])){
    if(!borrarImagenID($cn, $imagen)){
        echo "<p style='color:red'>No se ha podido borrar la imagen</p>";
    }else{
        header("Location: $anterior");
    }
}else{
    if(isset($_POST['no'])){
        header("Location: $anterior");
    }
}

?>
<br><br><br><br><br><br><br><br>
<div>
    <h1>¿Borrar imagen?</h1>
    <p>¿Relamente quieres borrar esta imagen?</p>
    <form action='<?php $_SERVER["PHP_SELF"]."?id_imagen=".$imagen ?>' method='POST'><p>
        <input type="submit" value="SI" name="si">
        <input type="submit" value="NO" name="no">
    </p></form>
</div>


<?php include './pie.php';?>