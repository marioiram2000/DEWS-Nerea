<?php
include 'header.php';
$items = getItemsNoVencidos($link);
if(isset($_POST['submitPujar'])){
    if($_POST['cantidad']!="" && is_numeric($_POST['cantidad'])){
        if(!isset($_SESSION['pujasFicticias'])){
            $_SESSION['pujasFicticias'] = array();
        }
        $id_item = $_POST['id_item'];
        $nombre = getItemNombre($link, $id_item);
        if(isset($_SESSION['pujasFicticias'][$id_item])){
            if($_SESSION['pujasFicticias'][$id_item][$nombre] < $_POST['cantidad']){
                $_SESSION['pujasFicticias'][$id_item][$nombre] = $_POST['cantidad'];
            }
        }else{
            if(getPrecioActual($link, $item['id']) < $_POST['cantidad']){
                $_SESSION['pujasFicticias'][$id_item][$nombre] = $_POST['cantidad'];
            }
        }
    }
}

if(isset($_POST['submitGrabar'])){
    foreach ($_POST['grabar'] as $id_item) {
        foreach ($_SESSION['pujasFicticias'][$id_item] as $nombre => $valor) {
            insertPuja($link, $id_item, getUsuarioFalso($link), $valor);
        }
    }
    echo "<h2 style='color:green;'>Pujas subidas<h2>";
    unset($_SESSION['pujasFicticias']);
}
?>
<h1>SUBASTAS VIGENTES</h1>
<table>
    <tr><th>ITEM</th><th>ULTIMA PUJA</th><th>QUEDAN</th><th>PUJA FICTICIA</th></tr>
    <?php
    foreach ($items as $item) {
        $t = (int)(abs(strtotime($item['fechafin'])-time())/60/60/24);
        
        if($t<=31){
            $quedan = $t." dias ";
        }else{
            $m = 0;
            while($t>31){
                $quedan = "";
                $t -=31;
                $m ++;
            }
            if($m<2){
                $quedan = ((int)$m). " mes ";
            }else{
                $quedan = ((int)$m). " meses ";
            }
            if($t>1){
                $quedan .= $t. " dias ";
            }else{
                $quedan .= $t. " dia";
            }
            
        }
        echo "<tr>";
            echo "<td>".$item['nombre']."</td>";
            if(count(getPujas($link, $item['id']))!=0){
                echo "<td>".getPrecioActual($link, $item['id']).DIVISA."</td>";
            }else{
                echo "<td>SIN PUJAS</td>";
            }
            echo "<td>Quedan $quedan</td>";
            if(count(getPujas($link, $item['id']))!=0){
                echo "<td> <form method='POST' action='".$_SERVER['PHP_SELF']."'>";
                if(isset($_SESSION['pujasFicticias'][$item['id']])){
                    echo "<input type='text' name='cantidad' value='".$_SESSION['pujasFicticias'][$item['id']][$item['nombre']]."'>";
                }else{
                    echo "<input type='text' name='cantidad'>";
                }
                echo "<input type='submit' name='submitPujar' value='Nueva puja ficticia'>";
                echo "<input type='hidden' name='id_item' value='".$item['id']."'>";
                echo "</form></td>";
            }else{
                echo "<td></td>";
            }
        echo "</tr>";
    }
    ?>
   
</table>
<?php
if(isset($_SESSION['pujasFicticias'])){
    echo "<h2>POSIBLES PUJAS FICTICIAS</h2>";
    echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
    echo "<ul>";
    foreach ($_SESSION['pujasFicticias'] as $id => $nomYprecio) {
        foreach ($nomYprecio as $nombre => $precio) {
            echo "<li>$nombre, $precio <input type='checkbox' name='grabar[]' value='$id' checked></li>";
        }
    }
    echo "</ul>";
    echo "<input type='submit' name='submitGrabar' value='Grabar pujas marcadas'>";
    echo "</form>";
}
include 'footer.php';
?>