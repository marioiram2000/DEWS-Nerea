<?php
$nombre = "";
$apellidos = "";
$email = "";
$username = "";
$psw1 = "";
$psw2 = "";
?>

<div class="div_inicio_contenedor">
    <img src= "<?php echo base_url().'imagenes/gato_persa_enfadado.jpg'; ?>" alt="Imagen de registro" height="300px" style='margin: 20px;'>
    <div class="div_inicio_texto">
        <h1>¡¿Te quieres registrar?!</h1>
        <h2>¡Solo tienes que rellenar el siguiente formulario!</h2>
        <?php
        echo form_open(site_url()."/c_formularios/registro");
        echo '<table class="tabla_formulario">';
            echo "<tr>";
                echo "<td>".form_label("Nombre:")."</td>";
                echo "<td>".form_input("nombre", set_value('nombre'))."</td>";
                echo "<td><p class='mensajeError'>". form_error('nombre') ."</p></td>";                
            echo "</tr>";
            echo "<tr>";
                echo "<td>".form_label("Apellidos:")."</td>";
                echo "<td>".form_input("apellidos", set_value('apellidos'))."</td>";
                echo "<td><p class='mensajeError'>". form_error('apellidos') ."</p></td>";
            echo "</tr>"; 
            echo "<tr>";
                echo "<td>".form_label("Correo:")."</td>";
                echo "<td>".form_input("correo", set_value('correo'))."</td>";
                echo "<td><p class='mensajeError'>". form_error('correo') ."</p></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>".form_label("Nombre de usuario:")."</td>";
                echo "<td>".form_input("username", set_value('username'))."</td>";
                echo "<td><p class='mensajeError'>". form_error('username') ."</p></td>";
            echo "</tr>";    
            echo "<tr>";
                echo "<td>".form_label("Contraseña:")."</td>";
                echo "<td>".form_password("psw1", set_value('psw1'))."</td>";
                echo "<td><p class='mensajeError'>". form_error('psw1') ."</p></td>";
            echo "</tr>";  
            echo "<tr>";
                echo "<td>".form_label("Repite la contraseña:")."</td>";
                echo "<td>". form_password("psw2", set_value('psw2'))."</td>";
                echo "<td><p class='mensajeError'>". form_error('psw2') ."</p></td>";
                
            echo "</tr>";   
        echo "</table>";        
        echo form_submit('submit', 'Registrarse');
        echo form_close();
        ?>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
            
        </form>
    </div>
</div>


