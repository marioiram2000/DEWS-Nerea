
<?php 
$tituloWeb ="Home";

include_once 'includes/cabecera.php';
$items=getItemsActivos($db);
session_start();

$error="";
if(isset($_POST['pFicticia'])) {
    $pujaARealizar = $_POST['pujar'];
    
    // cual es el precio actual?
    if (isset($_SESSION['ficticias'][$_POST['id']])) {
        $ultimaPuja = $_SESSION['ficticias'][$_POST['id']];
    } else {
        $ultimaPuja = getUltimaPuja($db, $_POST['id']);
    }

    //comprobar introducido y guardar en sesion 
    if (!is_numeric($pujaARealizar)) {
        $error="<span style='color:red'>El campo introducido no es un numero</span>";
    } else if ($ultimaPuja >= $pujaARealizar) {
        $error="<span style='color:red'>El valor introducido tiene que ser superior a la ultima puja</span>";
    } else {
        $_SESSION['ficticias'][$_POST['id']] = $pujaARealizar;
        $error="<span style='color:green'>Puja realizada</span>";
    }
    
}
if (isset($_POST['guardarPujas']) && isset($_POST['guardar'])) {
    $usuarios= usuariosFalsos($db);
    foreach ($_POST['guardar'] as $id) {
        
        if (pujaFicticia($db, $id, $_SESSION['ficticias'][$id], $usuarios)) {
            unset($_SESSION['ficticias'][$id]);
        }
        
    }
    $error="<span style='color:green'>Pujas ficticias realizadas</span>";

   
    
}


?>
<h1>SUBASTAS VIGENTES</h1>

<?php 
echo $error;
if (count($items) > 0) { ?>
<table>
    <tr>
        <th>Item</th>
        <th>Ultima puja</th>
        <th>quedan</th>
        <th>puja ficticia</th>
    </tr>
    
    <?php 
        foreach ($items as $item) {
            $ultimaPuja = getUltimaPuja($db, $item['id']);
            if (isset($_SESSION['ficticias'][$item['id']])) {
                $ultimaPuja = $_SESSION['ficticias'][$item['id']];
            }
            echo '<tr>';
            echo '<td>'.$item['nombre'].'</td>';
            echo '<td>';
            if ($ultimaPuja) {
                echo $ultimaPuja.APP_MONEDA;
            } else {
                echo "Sin pujas";
            }
            echo '</td>';
            
            echo '<td>';
            $fecha1=strtotime($item['fechafin']);
            $fecha2=time();
            $diferencia=$fecha1-$fecha2;
            $meses = (int)($diferencia/(60*60*24*30));
            $restante="";
            if ($meses > 0 ) {
                $restante = $meses." meses ";
                
            }
            $dias = $diferencia/(60*60*24) - $meses*30;
            $restante = $restante. (int)$dias." dias";
            
            
            echo $restante;
            
            echo '</td>';
            echo '<td>';
            if ($ultimaPuja) {
                echo "<form action='".$_SERVER['PHP_SELF']."' method='POST'>"
                . "<input type='text' name='pujar'>"
                . "<input type='submit' name='pFicticia' value='Nueva puja ficticia'>"
                . "<input type='hidden' name='id' value='".$item['id']."'>"
                . "</form>";
            }
            echo '</td>';

            echo '</tr>';
            
        }
    ?>
    
    
</table>

<?php 
    //existe $_SESSION['ficticias'] y contiene algo?
    if (isset($_SESSION['ficticias']) && count($_SESSION['ficticias'])) { 
        echo "<h1>POSIBLES PUJAS FICTICIAS</h1>";
        echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
        echo "<ul>";
        foreach ($_SESSION['ficticias'] as $idFicticia => $cantidadFicticia){
            echo "<li>".$items[$idFicticia]['nombre'].", ".$cantidadFicticia.APP_MONEDA
                    ."<input type='checkbox' value='".$idFicticia."' name='guardar[]'></li>";
        }
        echo "</ul>";
        echo "<input type='submit' name='guardarPujas' value='GRABAR PUJAS MARCADAS'>";
        echo "</form>";

    }
} else {
    echo "<span>No hay items que complan los requisitos de busqueda</span>";
    
}



include_once 'includes/footer.php';