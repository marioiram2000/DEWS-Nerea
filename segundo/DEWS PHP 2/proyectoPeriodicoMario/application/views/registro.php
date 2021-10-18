<div class="col-6 mx-auto my-5">
    <div class="border border-primary p-5 mx-auto rounded">
        <h1>Rellena el siguiente formulario para registrarte</h1>
        <?php
        echo form_open(site_url()."/c_registro/registro");
            if(isset($error))
                echo "<p class='text-danger'>$error</p>";
            
            echo '<div class="form-group">';
                echo form_label('Correo: '.form_error('correo', "<span class='text-danger'>", "</span>"), 'correo');
                echo form_input(array('name' => 'correo', 'value' => set_value('correo'), 'class' => 'form-control', 'id' => 'correo'));
            echo "</div>";
            echo '<div class="form-group">';
                echo form_label('Nombre: '.form_error('nombre', "<span class='text-danger'>", "</span>"), 'nombre');
                echo form_input(array('name' => 'nombre', 'value' => set_value('nombre'), 'class' => 'form-control', 'id' => 'nombre'));
            echo "</div>";
            echo '<div class="form-group">';
                echo form_label('Contraseña: '.form_error('password', "<span class='text-danger'>", "</span>"), 'password');
                echo form_password(array('name' => 'password', 'class' => 'form-control', 'id' => 'password'));            
            echo "</div>"; 
            echo '<div class="form-group">';
                echo form_label('Repetir contraseña: '.form_error('passconf', "<span class='text-danger'>", "</span>"), 'passconf');
                echo form_password(array('name' => 'passconf', 'class' => 'form-control', 'id' => 'passconf'));            
            echo "</div>"; 
            echo '<div class="form-group">';
                echo form_label('Telefono: '.form_error('telefono', "<span class='text-danger'>", "</span>"), 'telefono');
                echo form_input(array('name' => 'telefono', 'value' => set_value('telefono'), 'class' => 'form-control', 'id' => 'telefono'));
            echo "</div>";
            echo form_submit(array('name' => 'submit', 'value' => 'Registrarme', 'class' => 'btn btn-primary'));
        echo form_close();
            ?>
        
    </div>
</div>