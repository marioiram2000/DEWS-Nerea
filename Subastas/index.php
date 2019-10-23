<?php 
include './cabecera.php';
include './barra.php';
$_SESSION['actual']="http://localhost/Subastas/index.php";
$id_user = $_SESSION['id_user'];

if(isset($_GET['id_cat'])){
echo "<h1>Items disponibles</h1>";
echo "<table>";
    echo "<tr>";
        echo "<th>IMAGEN</th><th>ITEM</th><th>PUJAS</th><th>PRECIO</th><th>PUJAS HASTA</th>";
    echo "</tr>";
        $categoria= $_GET['id_cat'];
        $items = sacarItemsIndex($cn, $categoria);
        //print_r($items);
        foreach ($items as $item) {
            echo"<tr>";
                $imagen = sacarImagen($cn, $item->id);
                $pujas = sacarPujas($cn, $item->id);
                $pujaMasAlta = pujaMasAlta($cn, $item->id);
                $fecha = sacarFecha($cn, $item->id);
                echo "<td><img src='$imagen' alt='NO HAY IMAGEN' width='100'/></td>";//IMAGEN
                echo "<td><a href='http://localhost/Subastas/itemdetalles.php?item=$item->id'><strong><u>$item->nombre</u></strong></a>";//NOMBRE DEL ITEM
                if($id_user == sacarDueño($cn, $item->id)){
                    echo "<a href='http://localhost/Subastas/aniadeimagenes.php?idItem=$item->id'> - [editar]</a>";
                }
                echo "</td>";
                echo "<td>$pujas</td>";//CANTIDAD DE PUJAS
                echo "<td>$pujaMasAlta</td>";//PUJA MÁS ALTA
                echo "<td>$fecha</td>";//FECHA FINAL
            echo"</tr>";
        }
    }
    
echo "</table>";

?>





            
<?php include './pie.php';?>