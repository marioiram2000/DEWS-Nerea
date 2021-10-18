<div class="col-6 mx-auto my-5">
    <div class="border border-primary p-5 mx-auto rounded">
        <h1>Inicia sesión con tu correo</h1>
        <?php
        echo form_open(site_url()."/c_login/login");
            if(isset($error))
                echo "<p class='text-danger'>$error</p>";
            echo '<div class="form-group">';
                echo form_label('Correo: '.form_error('correo', "<span class='text-danger'>", "</span>"), 'correo');
                echo form_input(array('name' => 'correo', 'value' => set_value('correo'), 'class' => 'form-control', 'id' => 'correo'));
            echo "</div>";
            echo '<div class="form-group">';
                echo form_label('Contraseña: '.form_error('psw', "<span class='text-danger'>", "</span>"), 'psw');
                echo form_password(array('name' => 'psw', 'class' => 'form-control', 'id' => 'psw'));            
            echo "</div>";      
            echo form_submit(array('name' => 'submit', 'value' => 'Iniciar sesión', 'class' => 'btn btn-primary'));
        echo form_close();
        echo "<a href='". site_url()."/c_registro/'>¿No tienes cuenta? Registrate</a>";
            ?>
    </div>
</div>