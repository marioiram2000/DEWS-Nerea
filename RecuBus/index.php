<?php
include './includes/cabecera.php';
$rutaImagen = "images/";
$buses = getAutobuses($cn);
session_start();
session_destroy();
//print_r($buses);
echo "<table>";
foreach ($buses as $bus) {
    $id_placa=$bus->id_placa;
    $imagen=$bus->imagen;
    $marca= sacarmarca($imagen);
    $rutas = getRutas($cn, $id_placa);
    
    echo "<tr>";
        echo "<td>";
            echo "<img src='".$rutaImagen.$imagen."' style='width:100px;'>";
        echo "</td>";
        
        echo "<td>";
            echo $id_placa;
        echo "</td>";
        
        echo "<td>";
            echo $marca;
        echo "</td>";
        
        echo "<td>";
            echo "<table>";
                echo "<tr><th>".$rutas['cantidad']." RUTAS</th></tr>";
                for ($i = 0; $i < $rutas['cantidad']; $i++) {
                    echo "<tr><td>".$rutas[$i]['ciudadorigen']."</td>";
                    echo "<td>".$rutas[$i]['ciudaddestino']."</td>";
                    echo "<td>".date("d/m/Y", strtotime($rutas[$i]['horasalida']))."</td>";
                    $url = "http://localhost/RecuBus/reservar.php?id_ruta=".$rutas[$i]['id_ruta']
                            . "&ciudadorigen=".$rutas[$i]['ciudadorigen']
                            . "&ciudaddestino=".$rutas[$i]['ciudaddestino']
                            . "&id_placa=$id_placa";
                    echo "<td><a href='$url'>RESERVAR</a></td></tr>";
                }
            echo "</table>";
        echo "</td>";
    echo "</tr>";
}
echo "</table>";



include './includes/pie.php';
