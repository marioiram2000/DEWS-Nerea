<?php 
$tituloWeb ="Pujas vencidas";
include_once 'includes/cabecera.php';


$items=getItemsVencidosSinPuja($db);
$categorias=getCategorias($db);

?>

<h1>Items vencidos sin pujas</h1>

<?php if (count($items) > 0) { ?>
<table>
    <tr>
        <th>Categoria</th>
        <th>Item</th>
        <th>Finalizó el</th>
    </tr>
    
    <?php 
        foreach ($items as $item) {

            $fecha = date("d-M-y H:i", strtotime( $item['fechafin']));
            echo '<tr>';
            echo '<td>'.$categorias[$item['id_cat']].'</td>';
            echo '<td>';
            echo '<a href="'.$_SERVER['PHP_SELF'].'?id='.$item['id'].'">'.$item['nombre'].'</a>';
            // imprimir si seleccionado
            if (isset($_GET['id']) && $_GET['id'] == $item['id']){
                $itemDetallado = getItem($db, $item['id']);
                echo "<br><b>Ofertado por:</b> ".$itemDetallado['nombreUsuario'];
                echo "<br><b>Precio de partida:</b> ".$itemDetallado['preciopartida']. " " . APP_MONEDA;
                echo "<br><b>Descripcion:</b> ".$itemDetallado['descripcion'];
                
                //imagenes? 
                $imagenes = getImagenes($db, $item['id']);
                if (count($imagenes)>0) {
                    echo "<table><tr>";
                    
                    foreach ($imagenes as $imagen) {
                        echo "<td>";
                        echo "<img style=\"max-height: 65px;;\" src=\"data:image/jpg;base64,". base64_encode($imagen)."\" />";
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
} else {
    echo "<span>No hay items que complan los requisitos de busqueda</span>";
    
}


include_once 'includes/footer.php';