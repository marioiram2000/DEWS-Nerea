<?php
echo "<h1>Inicia sesión</h1>";

$direccion =  site_url()."/c_inicial/iniciar_sesion";
echo form_open($direccion);
echo form_label("Usuario: ", "username");
echo form_input("username", set_value('username'));
echo "<br>";echo "<br>";
echo form_label("Contraseña: ", "pas");
echo form_password("pas");
echo "<br>";
echo "<br>";
echo form_submit('submit', 'Iniciar sesion');
echo form_close();
?>





