<?php
include 'header.php';
$items = getItems($link);
$cat = "";
if(isset($_GET['categoria'])){
   $cat = $_GET['categoria'];
}
$_SESSION['urlanterior'] = $_SERVER['PHP_SELF'];
?>

<h1>Items disponibles</h1>
<table>
    <tr><th>IMAGEN</th><th>ITEM</th><th>PUJAS</th><th>PRECIO ACTUAL</th><th>CIERRE DE PUJA</th></tr>
    <?php
    foreach ($items as $item) {
        if($cat == "" || $cat == $item['id_cat']){
            $imagenes = getImagenesItem($link, $item['id']);
            $cantPujas = cantPujas($link, $item['id']);
            $enlace = "itemdetalles.php?item=".$item['id'];
            if($cantPujas==0){
                $precioActual = $item['preciopartida'];
            }else{
                $precioActual = getPrecioActual($link, $item['id']);
            }
            $fechafin = date("d/M/Y h:iA", strtotime($item['fechafin']));

            echo "<tr>";
                if(count($imagenes)>0){
                    $imagen = IMAGENES.$imagenes[0]['imagen'];
                    echo "<td><img src='$imagen' alt='No se ha podido poner la imagen' width='200px'></td>";
                }else{
                    echo "<td>Art. sin imagen</td>";
                }
                
                echo "<td><a href='$enlace'>".$item['nombre']."</a>";
                if(isset($_SESSION['uid']) && $_SESSION['uid']==$item['id_user']){
                    echo "<a href='editaritem.php?idArt=".$item['id']."&idUser=".$_SESSION['uid']."'>[EDITAR]</a>";
                }
                echo "</td>";
                echo "<td>$cantPujas</td>";
                echo "<td>".$precioActual.DIVISA."</td>";
                echo "<td>".$fechafin."</td>";
            echo "</tr>";
        }
    }
    ?>
    
</table>

<?php
include 'footer.php';
?>