<?php
/*
 * libro objeto con propiedades de libro y nombre de autor
 * fechas array de objets con propiedad fehca
 */

echo "<h3>$libro->titulo</h3>";
echo "<p>$libro->paginas páginas, género: $libro->genero, autor: $libro->autor</p>";

echo "<h3>Fechas prestado</h3>";
foreach ($fechas as $fecha) {
    echo "<p>$fecha</p>";
}
?>