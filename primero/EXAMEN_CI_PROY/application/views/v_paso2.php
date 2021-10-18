<?php
/*
 * le llega $dia con la fecha escogida, $cine con el nombre y $funciones con un array de funciones
 * Array ( [0] => Array ( [idfuncion] => 1 [num_sala] => 1 [hora] => 17:00:00 [precio_entrada] => 6.6 [titulo] => Ad Astra ) )
 */
if(count($funciones)==0){
    echo "<h1>No hay funciones el $dia en los cines $cine </h1>";
}else{
    echo "<h1>Funciones del $dia en los cines $cine </h1>";
    echo "<table border=1>";
    echo "<tr>";
        echo "<th>Película</th><th>Cines</th><th>NºSala</th><th>Hora</th><th>Precio</th><th>COMPRAR</th>";
    echo "</tr>";
    foreach ($funciones as $funcion) {
        echo "<tr>";
            echo "<td>".$funcion['titulo']."</td>";
            echo "<td>".$cine."</td>";
            echo "<td>".$funcion['num_sala']."</td>";
            echo "<td>".$dia." ".$funcion['hora']."</td>";
            echo "<td>".$funcion['precio_entrada']."€</td>";
            $url = site_url()."/c_cines/paso3/".$funcion['idfuncion']."/".$funcion['num_sala']."/".$funcion['precio_entrada'];
            echo "<td>".anchor($url, 'Comprar entrada')."</td>";
            
        echo "</tr>";
    }
    echo "</table>";
}




