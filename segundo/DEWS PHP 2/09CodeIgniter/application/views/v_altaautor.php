<?php
/*
 * recive:
 *      mens_insercion que tiene "", "true", "false";
 */
$opciones = array('Francia'=>'Francia','EEUU'=>'EEUU','Rusia'=>'Rusia','Otra'=>'Otra');

echo "<h3>NUEVO AUTOR</h3>";
echo form_open('c_autores/alta');
echo "<p>Nombre ". form_input('nombre','');
echo "Fecha de nacimiento ". form_input('fechanac','');
echo "Nacionalidad ". form_dropdown("nacionalidad", $opciones, 'Rusia');
echo form_submit('submitalta', 'Nuevo autor')."</p>";

echo form_close();

if($mens_insercion!=null){
    if($mens_insercion){
        echo "<p>Inserción correcta</p>";
    }else{
        echo "<p>Inserción incorrecta</p>";
    }
}
?>
