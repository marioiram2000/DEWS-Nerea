<?php
include 'header.php';
$_SESSION['urlanterior'] = $_SERVER['PHP_SELF'];


if(isset($_POST['submitBorrar'])){
    if(count($_POST['borrar'])>0){
        foreach ($_POST['borrar'] as $id_item) {
            borrarPujas($link, $id_item);
            borrarItem($link, $id_item);
        }
    }
}

$items = getItemsVencidos($link);

echo "<table>";
    echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
    foreach ($items as $item) {
        $cantPujas = cantPujas($link, $item['id']);
        $ganador = "";
        if($cantPujas==0){
            $precioFinal = $item['preciopartida'];
            $ganador = "No ha pujado nadie";
        }else{
            $precioFinal = getPrecioActual($link, $item['id']);
            $ganador = getGanadorPuja($link, $item['id']);
        }
        
        $enlace = $_SERVER['PHP_SELF']."?desc=".$item['id'];
        echo "<tr>";
            echo "<td><input type='checkbox' name='borrar[]' value='".$item['id']."'></td>";
            echo "<td><a href='$enlace&itemDetalles=".$item['id']."'>".$item['nombre']."</a>";
            if(isset($_GET['itemDetalles']) && $_GET['itemDetalles'] == $item['id']){
                echo "<br>".$item['descripcion'];
            }
            echo "</td>";
            echo "<td>".$precioFinal.DIVISA."</td>";
            echo "<td>Ganador: $ganador</td>";
        echo "</tr>";
    }
    echo "<tr><td colspan='4'><input type='submit' name='submitBorrar' value='BORRAR'></td></tr>";
    echo "</form>";
echo "</table>";
?>

<?php
include 'footer.php';
?>