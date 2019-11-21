<?php
echo "<h1>Inicia sesión</h1>";

$direccion =  site_url()."/c_formularios/iniciar_sesion";
echo form_open($direccion);
    echo form_label("Usuario: ", "username");
    echo form_input("username", set_value('username'));
    echo "<br>";echo "<br>";
    echo form_label("Contraseña: ", "psw");
    echo form_password("psw");
    echo "<br>";
    echo "<br>";
    echo form_submit('submit', 'Iniciar sesion');
echo form_close();
?>
<br>
<br>
<br>
<br>
<img src="<?php echo base_url().'imagenes/corgi.jpg';?>" alt="Tu navegador no soporta el formato de la imagen" width="1000px">
