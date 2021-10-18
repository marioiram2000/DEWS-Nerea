<?php
/*
 * Le llega:
 * $libros (array de objetos) 
 * $cantLibros (int)
 */
echo "<ol>";
foreach ($libros as $libro) {
    $enlace = site_url()."/c_listado/verLibro/$libro->idlibro";
    echo "<li><a href='$enlace'>$libro->titulo</a></li>";
}
echo "</ol>";


echo "<p>$cantLibros</p>";
?>