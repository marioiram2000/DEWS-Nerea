<?php 
include './cabecera.php';
include './barra.php';



if(isset($_GET['id_cat'])){
echo "<h1>Items disponibles</h1>";
echo "<table>";
    echo "<tr>";
        echo "<th>IMAGEN</th><th>ITEM</th><th>PUJAS</th><th>PRECIO</th><th>PUJAS HASTA</th>";
    echo "</tr>";
        $categoria= $_GET['id_cat'];
        $items = sacarItemsIndex($cn, $categoria);
        print_r($items);
        foreach ($items as $item) {
            //echo $item;
            $imagen = sacarImagen($cn, $item->id);
            $pujas = sacarPujas($cn, $item->id);
            $pujaMasAlta = pujaMasAlta($cn, $item->id);
            echo "<td><img src='$imagen' alt='NO HAY IMAGEN'</td>";//IMAGEN
            echo "<td>$item->nombre</td>";//NOMBRE DEL ITEM
            echo "<td>$pujas</td>";//CANTIDAD DE PUJAS
            echo "<td>$pujaMasAlta</td>";//PUJA MÁS ALTA
            echo "<td></td>";//FECHA FINAL
        }
    }
    
echo "</table>";

?>





            
<?php include './pie.php';?>