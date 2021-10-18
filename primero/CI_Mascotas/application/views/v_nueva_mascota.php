<?php
echo form_open(site_url()."/c_formularios/nueva_mascota");
echo '<table class="tabla_formulario">';
    echo "<tr>";
        echo "<td>".form_label("Nombre:")."</td>";
        echo "<td>".form_input("nombre", set_value('nombre'))."</td>";
        echo "<td><p class='mensajeError'>". form_error('nombre') ."</p></td>";
    echo "</tr>";  
    echo "<tr>";
        echo "<td>".form_label("Edad:")."</td>";
        echo "<td>".form_input("edad", set_value('edad'))."</td>";
        echo "<td><p class='mensajeError'>". form_error('edad') ."</p></td>";
    echo "</tr>";  
    echo "<tr>";
        echo "<td>".form_label("Especie:")."</td>";
        echo "<td>".form_input("especie", set_value('especie'))."</td>";
        echo "<td><p class='mensajeError'>". form_error('especie') ."</p></td>";
    echo "</tr>";
    echo "<tr>";
        echo "<td>".form_label("Introduce una de sus fotos")."</td>";
        echo "<td>". form_upload("imagen", set_value('imagen'))."</td>";
        echo "<td><p class='mensajeError'>". form_error('imagen') ."</p></td>";

    echo "</tr>";   
echo "</table>";        
echo form_submit('submit', 'Registrar');
echo form_close();
?>
<img src="<?php echo base_url().'imagenes/gato_persa.jpg';?>" alt="Tu navegador no soporta el formato de la imagen" width="500px">

