<?php
/*
 * le llega id mascota y $imagenes
 */
echo '<br><table>';
    echo '<tr>';
        echo '<th>Subir fotos</th>';
        echo '<td>';
        echo form_open(site_url()."/c_formularios/gestionFotos/$id_mascota/subida");
        echo form_upload("imagen", set_value('imagen'));    
        echo '</td><td>';
        echo form_submit('subir', 'Subir');
        echo form_close();
        echo '</td>';
    echo '</tr>';
echo '</table><br>';
echo '<table>';
    echo '<tr>';
        echo '<th>Borrar fotos</th>';           
        foreach ($imagenes as $imagen) {
            echo '<td>';
                echo "<img src='".base_url().$imagen['ruta']."' alt='tu navegador no soporta el formato de la imagen' width='100' style='margin:5px;'>";
                echo form_open(site_url()."/c_formularios/gestionFotos/$id_mascota/borrada");
                echo form_hidden("ruta", $imagen['ruta']);
                echo form_submit('borrar', 'Eliminar');
                echo form_close();                   
            echo '</td>';
        }  
    echo '</tr>';
echo '</table>';
