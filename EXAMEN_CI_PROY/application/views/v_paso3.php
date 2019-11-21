<?php
/*
 * le llega $realizada, un booleano diciendo si se ha podido realizar la compra
 * $funcion con el id de la funcion
 * y $ total con el total de la compra
 */
if(!$realizada){
    echo "<h1>No se ha podido realizar la venta, no quedan entradas disponibles</h1>";
}else{
    echo "<h1>Entrada vendida para la funcion $funcion</h1>";
}
echo "<h2>Total: ".$total."€</h2>";