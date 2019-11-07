<!--Le llega:
    -$genero, con el genero seleccionado
    -$libros, con los libros de ese genero p.e.
Array ( [id] => 3 [titulo] => Grandes esperanzas [autor] => Charles Dickens )
-->
<div>
    <table>
        <caption>
          <?php echo $genero ;?>
        </caption>
        <tr>
            <th>Selecciona</th>
            <th>Libro</th>
            <th>Autor</th>
        </tr>
        <?php
            echo form_open(site_url()."/c_prestamos/prestar/$genero");
            foreach ($libros as $libro) {
                echo "<tr>";
                  echo "<td>".form_checkbox('seleccionado[]', $libro['id'])."</td>";
                  echo "<td>".$libro['titulo']."</td>";
                  echo "<td>".$libro['autor']."</td>";
              echo "</tr>";
            }
            echo '<tr><td colspan=3>';
            echo form_submit('submit', 'Prestar libros');
            echo '<td></tr>';
            echo form_close();
        ?>
    </table>
    
    <?php
    if (isset($titulos)){
        echo "<h3>LIBROS PRESTADOS</h3>";
        echo "<ul>";
        foreach ($titulos as $titulo) {
            echo "<li>$titulo</li>";
        }
        echo "</ul>";
        
        echo "<h5>Hay un máximo de 4 prestamos por titulo, por lo que si un libro que ha pretendido pedir no se encuentra en la lista, es por que se ha alcanzado el máximo. Sentimos las molestias.</h5>";
    }
    ?>
    
</div>