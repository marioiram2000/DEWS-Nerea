<?php
include './cabecera.php';
include './barra.php';

$id_item = $_GET['idItem'];
$_SESSION['actual']="http://localhost/Subastas/aniadeimagenes.php?idItem=$id_item";
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
        echo "<td><img src='$img' alt='imagen del item' width='100'></td>";
        $id_imagen = sacarIdImagen($cn, $img, $id_item);
        echo "<td><a href='borrarimagen.php?id_imagen=$id_imagen'>[delete]</a></td>";
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

echo "Cuando temines de subir fotos, <a href='http://localhost/Subastas/itemdetalles.php?item=$id_item'>ve a ver tu item!</a>";
?>


<?php include './pie.php';?>