<?php
$nombre = "";
$apellidos = "";
$email = "";
$username = "";
$psw1 = "";
$psw2 = "";
$errorUsername="";
$errorContraseñas="";
?>

<div class="div_inicio_contenedor">
    <img src= "<?php echo base_url().'imagenes/loro.png'; ?>" alt="Imagen de bienvenida" width="300px">
    <div class="div_inicio_texto">
        <h1>¡¿Te quieres registrar?!</h1>
        <h2>¡Solo tienes que rellenar el siguiente formulario!</h2>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
            <table class="tabla_formulario">
                <tr>
                    <td><label for="nombre">Nombre:</label></td>
                    <td><input type="text" name="nombre" id="nombre" value="<?php $nombre?>"></td>
                </tr>
                <tr>
                    <td><label for="apellidos">Apellidos:</label></td>
                    <td><input type="text" name="apellidos" id="apellidos" value="<?php $apellidos?>"></td>
                </tr>
                <tr>
                    <td><label for="correo">Correo:</label></td>
                    <td><input type="email" name="correo" id="correo" value="<?php $email?>"> </td>
                </tr>
                <tr>
                    <td><label for="username">Nombre de usuario:</label></td>
                    <td><input type="text" name="username" id="username" value="<?php $username?>"> </td>
                    <td><p class="mensajeError"><?php $errorUsername?></p></td>
                </tr>
                <tr>
                    <td><label for="psw1">Contraseña:</label></td>
                    <td><input type="password" name="psw1" id="psw1" value="<?php $psw1?>"></td>
                    <td><p class="mensajeError"><?php $errorContraseñas?></p></td>
                </tr>
                <tr>
                    <td><label for="psw2">Repite la contraseña:</label></td>
                    <td><input type="password" name="psw2" id="psw2" value="<?php $psw2?>"></td>
                </tr>
            </table>
        </form>
    </div>
</div>


