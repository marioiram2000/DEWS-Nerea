<!--Le llega:
    -$genero, con el genero seleccionado
    -$libros, con los libros de ese genero p.e.
PoesiaArray ( [0] => Array ( [idlibro] => 10 [titulo] => Viaje del Parnaso [idautor] => 2 ) )
-->
<div>
    <table>
        <caption>
          <?php echo $genero ;?>
        </caption>
        <tr>
            <th>Libro</th>
            <th>Autor</th>
        </tr>
        <?php
            print_r($libros);
            
            echo form_open('empleados/nuevo_empleado');
            foreach ($libros as $libro) {
                echo "<tr>";
                  echo "<td>".form_checkbox('seleccionado', true)."</td>";
                  echo "<td>".$libro['titulo']."</td>";
                  echo "<td>".$libro['autor']."</td>";
              echo "</tr>";
            }
            input[type="submit"]{
                padding:6px 10px 5px;
                font-size: 14px;
                background-color: #555555;
                font-weight:bold;
                color: #ffffff;
                border-radius:30px;
                border 1px solid #999;
            }
            form_submit('submit', 'submit', "style=''");
            echo form_close();
        ?>
    </table>
    
</div>