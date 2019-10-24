<?php 
include './cabecera.php';
include './barra.php';

$id_item = "";
if(isset($_GET['id_item'])){
    $id_item = $_GET['id_item'];
    $datosExtra = sacarExtra($cn, $id_item);
    print_r($datosExtra->id_user); 
    $extraNombre = $datosExtra->id_user;
    $extraPrecio = $datosExtra->preciopartida;
    $extraDescripcion = $datosExtra->descripcion;

    
    
}

$items_no_pujados = sacarItemsNoPujados($cn);
//print_r($items_no_pujados);
echo "<table>";
echo "<tr><th>CATEGORIA</th><th>ITEM</th><th>FINALIZÓ EL</th></tr>";

foreach ($items_no_pujados as $item) {    
    $id_cat = $item->id_cat;
    $nombre = $item->nombre;
    $fechafin = $item->fechafin;
    $id = $item->id;
    $categoria = sacarCategoria($cn, $id_cat);
    $fechafin = formatearFecha($fechafin);
    echo "<br>";
    echo "<tr>";
        echo"<td>$categoria</td>";
        if($id_item==$id){
            echo "<td><a href='subastas_vencidas?id_item=$id'>$nombre</a>";
            echo "<p><strong>Ofertado por:</strong>$extraNombre</p>";
            echo "<p><strong>Precio de partida:</strong>$extraPrecio</p>";
            echo "<p><strong>Descripcion:</strong>$extraDescripcion</p>";
            echo "</td>";
        }
        else{
            echo"<td><a href='subastas_vencidas?id_item=$id'>$nombre</a></td>";
        }
        echo"<td>$fechafin</td>";
    echo "</tr>";
}
echo "</table>";

include './pie.php';?>