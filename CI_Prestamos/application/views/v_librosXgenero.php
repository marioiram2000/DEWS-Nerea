<!--Le llega:
    -$genero, con el genero seleccionado
    -$libros, con los libros de ese genero p.e.
PoesiaArray ( [0] => Array ( [idlibro] => 10 [titulo] => Viaje del Parnaso [idautor] => 2 ) )
-->
<div>
    <table>
        <caption>
          <?php echo $genero;?>
        </caption>
        <tr>
            <th>Libro</th>
            <th>Autor</th>
        </tr>
        <?php
          foreach ($libros as $libro) {
              echo "<tr>";
                echo "<td></td>";
                echo "<td>".$libro['titulo']."</td>";
                echo "<td>".$libro['titulo']."</td>";
            echo "</tr>";
          }
        
        ?>
    </table>
    
</div>