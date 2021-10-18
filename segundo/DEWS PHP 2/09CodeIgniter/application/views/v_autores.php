<?php
echo "<ul>";
foreach ($autores as $autor) {
    $enlace = site_url()."/c_autores/librosAutor/".$autor['idautor'];
    echo "<li><a href='$enlace'>".$autor['nombre']."</a></li>";
}
echo "</ul>";