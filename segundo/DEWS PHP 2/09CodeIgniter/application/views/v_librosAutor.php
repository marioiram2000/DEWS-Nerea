<?php
echo "<ul>";
foreach ($libros as $libro) {
    echo "<li>";
        echo $libro['titulo'].", ".$libro['paginas']." páginas, ".$libro['genero'];
    echo "</li>";
}
echo "</ul>";
$enlace = site_url()."/c_autores/index";
echo "<a href='$enlace'>Volver</a>";
?>