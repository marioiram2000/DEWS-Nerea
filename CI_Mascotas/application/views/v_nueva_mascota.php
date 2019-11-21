<?php
/*
echo form_open_multipart(site_url()."/c_formularios/nueva_mascota");
echo '<table class="tabla_formulario">';
    echo "<tr>";
        echo "<td>".form_label("Nombre:")."</td>";
        echo "<td>".form_input("nombre", set_value('nombre'))."</td>";
        echo "<td><p class='mensajeError'>". form_error('nombre') ."</p></td>";
    echo "</tr>";  
    echo "<tr>";
        echo "<td>".form_label("Edad:")."</td>";
        echo "<td>".form_input("edad", set_value('edad'))."</td>";
        echo "<td><p class='mensajeError'>". form_error('psw1') ."</p></td>";
    echo "</tr>";  
    echo "<tr>";
        echo "<td>".form_label("Introduce sus fotos")."</td>";
        echo "<td>". form_upload("imagenes", set_value('imagenes'))."</td>";
        echo "<td><p class='mensajeError'>". form_error('imagenes') ."</p></td>";

    echo "</tr>";   
echo "</table>";        
echo form_submit('submit', 'Registrarse');
echo form_close();
 */

$datestring = 'Year: %Y Month: %m Day: %d - %h:%i %a';
$time = time();
echo mdate($datestring, $time);

echo "<br>";echo "<br>";echo "<br>";

$format = 'DATE_RFC822';
$time = time();
echo standard_date($format, $time);

echo "<br>";echo "<br>";echo "<br>";

echo unix_to_human(time(), false, 'eu');

echo "<br>";echo "<br>";echo "<br>";

$post_date = '1079621429';
$now = time();
$units = 2;
echo timespan($post_date, $now, $units);

echo "<br>";echo "<br>";echo "<br>";

$range = date_range('2012-01-01', '2012-01-15');
echo "First 15 days of 2012:";
foreach ($range as $date)
{
        echo $date."\n";
}
?>

