<?php
echo "<h1>Inicia sesión</h1>";

$direccion =  site_url()."/c_formularios/iniciar_sesion";
echo form_open($direccion);
echo form_label("Usuario: ", "username");
echo form_input("username", set_value('username'));
echo form_error('username');
echo "<br>";echo "<br>";
echo form_label("Contraseña: ", "psw");
echo form_password("psw");
echo form_error('psw');
echo "<br>";
echo "<br>";
echo form_submit('submit', 'Iniciar sesion');
echo form_close();
?>





