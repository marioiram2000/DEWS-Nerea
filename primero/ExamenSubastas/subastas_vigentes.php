<?php 
include './cabecera.php';
include './barra.php';
$itemsVigentes = sacarItemsVigentes($cn);
$ListaPujasFicticias = "<h2>POSIBLES PUJAS FICTICIAS</h2>";;

$nombres = array();
foreach ($itemsVigentes as $item) {
    $nombres[] = $item->nombre;
    foreach ($nombres as $nombre) {   
        if(isset($_POST["submit_$nombre"])){
            $cantidad = $_POST["puja_$nombre"];
            $id_item = $item->id;
            guardarEnLaSesion($cn, $cantidad, $nombre, $id_item);
        }
    }

}
if(isset($_POST['grabar_pujas'])){
    $elegidos = $_POST['elegidos'];
    grabarpujas($elegidos);
}
$ListaPujasFicticias .= cargarLista($ListaPujasFicticias);

echo "<table>";
echo "<tr><th>ITEM</th><th>ULTIMA PUJA</th><th>QUEDAN</th><th>PUJA FICTICIA</th></tr>";
$self = $_SERVER['PHP_SELF'];
echo "<form method='POST' action='$self'>";
foreach ($itemsVigentes as $item) {
    $nombre = $item->nombre;
    $fechafin = $item->fechafin;
    $id_item = $item->id;
    $pujamasalta= pujaMasAlta($cn, $id_item);
    $cuantoqueda= cuantoqueda($cn, $fechafin);
    
    echo "<tr>";
        echo"<td>$nombre</td>";
        echo"<td>$pujamasalta</td>";
        echo"<td>$cuantoqueda</td>";
        $self = $_SERVER['PHP_SELF'];
        if($pujamasalta != "Sin pujas"){
            echo"<td><input type='text' name='puja_$nombre'><input type='submit' name='submit_$nombre' value='Nueva puja ficticia'></td>";
        }
        echo "</tr>";
    
}
echo '</from>';
echo "</table>";

echo "<ul>";
$self = $_SERVER['PHP_SELF'];
echo "<form method='POST' action='$self'>";
    echo $ListaPujasFicticias;
    echo "<input type='submit' name='grabar_pujas' value='Grabar pujas marcadas'>";
echo '</from>';
echo "</ul>";

include './pie.php';?>