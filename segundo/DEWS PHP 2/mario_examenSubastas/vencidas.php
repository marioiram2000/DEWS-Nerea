<?php
include 'header.php';
$items = getItemsVencidos($link);
?>
<h1>Últimas subastas vencidas</h1>
<table>
    <tr><th>FINALIZÓ EL</th><th>CATEGORIA</th><th>ITEM</th><th>GANADOR</th></tr>
    <?php
    foreach ($items as $item) {
        $fecha = date("d-M-y H:i");
        $cat = getCategoriaItem($link, $item['id_cat']);
        $ganador = getGanadorPuja($link, $item['id']);
        $enlace = RUTA."vencidas.php?pujaDetalles=".$item['id'];
        if(isset($_GET['pujaDetalles']) && $_GET['pujaDetalles']==$item['id']){
            echo "<tr style='background-color: yellow;'>";
        }else{
            echo "<tr>";
        }
            echo "<td>".$fecha."</td>";
            echo "<td>".$cat."</td>";
            echo "<td>".$item['nombre']."</td>";
            if($ganador == false){
                echo "<td>SIN PUJAS</td>";
            }else{                
                if(isset($_GET['pujaDetalles']) && $_GET['pujaDetalles']==$item['id']){
                    $precio = getPrecioActual($link, $item['id']);
                    $porcen = (($precio/$item['preciopartida'])-1)*100;
                    
                    echo "<td>";
                    echo "<a href='$enlace'><u><strong>".$ganador."</strong></u></a><br>";
                    echo "Ganado por ".$precio.DIVISA."<br>";
                    echo $porcen."% superior al precio de partida (".$item['preciopartida'].DIVISA.")<br>";
                    echo "</td>";
                }else{
                    echo "<td><a href='$enlace'><u><strong>".$ganador."</strong></u></a></td>";
                }
            }
        echo "</tr>";
    }
    ?>
</table>

<?php
include 'footer.php';
?>
