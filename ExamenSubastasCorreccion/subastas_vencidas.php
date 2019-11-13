<?php
include './cabecera.php';
include './barra.php';
$id_get = "";
if (isset($_GET['id'])){
    $id_get=$_GET['id'];
}


$items = items_vencidos_sin_pujas($cn);
$categorias = sacarCategorias($cn);
?>

<p>Items vencidos sin pujas</p>
<table>
    <tr>
        <th>CATEGORIA</th>
        <th>ITEM</th>
        <th>FINALIZÓ EL</th>
    </tr>
    <?php
    foreach ($items as $item) {
        $fecha = date("d-M-y H:i", strtotime($item->fechafin));
        echo '<tr>';
        echo '<td>'.$categorias[$item->id_cat].'</td>';
        echo '<td>';
        echo '<a href="'.$_SERVER['PHP_SELF'].'?id='.$item->id.'">'. strtoupper($item->nombre) .'</a>';
        if ($id_get == $item->id){
            $itemDetallado = sacarItem($cn, $item->id);
            
            echo "<br><b>Ofertado por:</b> ".$itemDetallado->nombre;
            echo "<br><b>Precio de partida:</b> ".$itemDetallado->preciopartida. " €";
            echo "<br><b>Descripcion:</b> ".$itemDetallado->descripcion;
            $id = $item->id;
            //imagenes? 
            $imagenes = getImagenes($cn, $id);
            //print_r($imagenes);
            if (count($imagenes)>0) {
                
                echo "<table><tr>";
                foreach ($imagenes as $imagen) {
                    echo "------------------$imagen-----------";
                    echo "<td>";
                    echo "<img src='data:image/jpj;base64,". base64_encode($imagen)."' style='max-height: 65px;' alt='Imagen'>";
                    echo "</td>";
                }
                echo "</tr></table>";
            }
        }
        echo '</td>';
            echo '<td>'.$fecha.'</td>';
        echo '</tr>';
    }
    ?>    
</table>

<?php 
include './pie.php';
?>