<?php
include './includes/cabecera.php';
session_start();
//session_destroy();
$id_ruta = $_GET['id_ruta'];
$ciudadorigen = $_GET['ciudadorigen'];
$ciudaddestino = $_GET['ciudaddestino'];
$id_placa = $_GET['id_placa'];

$capacidad = getCapacidad($cn, $id_placa);
$lineas = $capacidad/4;
if($capacidad%4!=0){
    $lineas ++;
}
$lineas = intval($lineas);

$asientosReservados=getReservas($cn, $id_ruta);
$cont = 1;

foreach ($asientosReservados as $asientoReservado) {
    $_SESSION['marcados'][] = $asientoReservado;
}
$errorDNI = "";
if(isset($_POST['grabar'])){
    $dni = $_POST['dni'];
    $existe = buscarDni($cn, $dni);
    if($existe){
        $cantidad = count($_SESSION['seleccionados']);
        header("Location:grabarreservas.php?id_ruta=$id_ruta&cantidad=$cantidad&dni=$dni");
    }else{
        $errorDNI = "DNI $dni no puede reservar";
    }
    
}
if(isset($_POST['borrar'])){
    if(isset($_SESSION['seleccionados'])){
        if(isset($_POST['checkBorrar'])){
            foreach ($_POST['checkBorrar'] as $value) {
                $indice = array_search($value, $_SESSION['seleccionados']);
                $_SESSION['seleccionados'][$indice]=null;
                $_SESSION['marcados'][$indice]=null;
            }
        }
        //print_r($_SESSION['seleccionados']);
    }
    
}

if(isset($_POST['marcado'])){
    
    if(!isset($_POST['asientos'])){
        echo "<p style='color:red;'>Ningun asiento seleccionado</p>";
    }else{
        foreach ($_POST['asientos'] as $asientoMarcado) {
            $_SESSION['marcados'][]=$asientoMarcado;
            $_SESSION['seleccionados'][]=$asientoMarcado;
        }
    }
    
}
if(isset($_POST['azar'])){
    $asientoAleatorio = rand(1, $capacidad);
    while(in_array($asientoAleatorio, $asientosReservados)){
        $asientoAleatorio = rand(1, $capacidad);
    }
    $_SESSION['marcados'][]=$asientoAleatorio;
    $_SESSION['seleccionados'][]=$asientoAleatorio;
}

$url = "http://localhost/RecuBus/reservar.php?id_ruta=".$id_ruta
                            . "&ciudadorigen=".$ciudadorigen
                            . "&ciudaddestino=".$ciudaddestino
                            . "&id_placa=$id_placa";
echo "<form method='POST' action='".$url."'>";
echo "<table>";
    echo "<tr><th>Reservando ruta $ciudadorigen - $ciudaddestino (Capacidad $capacidad)</th></tr>";
    for ($i = 0; $i < $lineas; $i++) {
        echo "<tr>";
        for ($j = 0; $j < 4; $j++) {
            if($cont<=$capacidad){
                if($j==2){
                    echo "<td>|||||||</td>";
                }
                if(in_array($cont, $asientosReservados)){
                    echo "<td disabled style='color:red'><input type='radio' name='asientos[]' value='$cont' > Asiento $cont</td>";
                }else{
                    if(in_array($cont, $_SESSION['marcados'])){
                        echo "<td style='border: 1px solid black;'><input type='radio' name='asientos[]' disabled  checked='checked' value='$cont' > Asiento $cont</td>";
                    }else{
                        echo "<td style='border: none;'><input type='radio' name='asientos[]' value='$cont' > Asiento $cont</td>";
                    }
                }
                
            }$cont++;
        }
        echo "</tr>";
    }
echo "</table>";
echo '<input type="submit" name="marcado" value="Reservar marcado">';
echo '<input type="submit" name="azar" value="Reservar al azar">';
echo "</form>"; 

echo '<br><br>';

if(isset($_SESSION['seleccionados'])){
    echo "<form method='POST' action='$url'>";
    echo count($_SESSION['seleccionados'])." ASIENTOS RESERVADOS <br>";
    foreach ($_SESSION['seleccionados'] as $value) {
        if($value!=null){
            echo "<input type='checkbox' name='checkBorrar[]' value='$value'>$value";
        }
        
    }
    echo "<br>";
    echo '<input type="submit" name="borrar" value="Borrar asientos">';
    echo "</form>";
}
if(isset($_SESSION['seleccionados'])){
    echo "<form method='POST' action='$url'>";
        echo "DNI<br>";
        echo "<input type='text' name='dni'><br>";
        echo '<input type="submit" name="grabar" value="Grabar reserva">';
    echo "</form>";
}
echo "<p style='color:red'>$errorDNI</p>";
include './includes/pie.php';
