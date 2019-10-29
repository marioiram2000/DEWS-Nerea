<?php
//le llegan autores con idautor nombre fechanac y nacionalidad
echo "<table>";
foreach ($autores as $autor) {
    echo "<tr>";
        echo "<td>$autor->nombre</td>";
        echo "<td>$autor->nacionalidad</td>";
        echo "<td><a href='c_autores/verautor/$autor->idautor'>VER LIBROS</a></td>";
        
    echo "</tr>";
}
echo "</table>";

?>