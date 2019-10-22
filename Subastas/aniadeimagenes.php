<?php
include './cabecera.php';
include './barra.php';

$id_item = $_GET['idItem'];
$errorImagen="";

echo "<h1>Imagenes actuales</h1>";

if(isset($_POST['submit'])){
    if($_POST['imagen']==""){
        $errorImagen = "<p style='color:red'>No se ha seleccionado ninguna imagen</p>";
    }else{
        $imagen = "imagenes/".$_POST['imagen'];
        if(!insertarImagen($cn, $id_item, $imagen)){
            $errorImagen = "<p style='color:red'>No se ha podido subir la imagen</p>";
        }
    }
}
echo $errorImagen;

 $imagenes = sacarImagenes($cn, $id_item);
 if (count($imagenes)==0)
     echo "No hay imagenes</p>";
 else{
    echo "<table border='1'>";
    foreach ($imagenes as $img) {
        echo "<tr>";
        echo "<td><img src='$img' alt='imagen del item'></td>";
        echo "<td><a href='borrarimagen.php?imagen=$imagen'>[delete]</a></td>";
        echo "</tr>";
    }
    echo '</table>';
 }

$self = $_SERVER["PHP_SELF"]."?idItem=".$id_item;
echo "<table border='1'>";
echo "<form action='$self' method='POST'>";
    echo "<tr><td><strong>Imagen a subir</strong></td><td> <input type='file' name='imagen'></td></tr>";
    echo "<tr><td><input type='submit' name='submit' value='Subir'></td></tr>";
echo "</form>";
echo '</table>';

echo "Cuando temines de subir fotos, <a href=''>ve a ver tu item!</a>";
?>


<?php include './pie.php';?>