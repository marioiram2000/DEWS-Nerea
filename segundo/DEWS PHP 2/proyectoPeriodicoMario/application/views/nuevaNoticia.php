<div class="col-9 my-3  mx-auto">
    <?php   
    echo form_open_multipart(site_url()."/c_noticias/validarNuevaNoticia");
        echo '<div class="form-group">';
            echo form_label('Título de la noticia '.form_error('titulo', "<span class='text-danger'>", "</span>") , 'titulo');
            echo form_textarea(array('name' => 'titulo', 'value' => set_value('titulo'), 'class' => 'form-control', 'id' => 'titulo'));
        echo '</div>';
        echo '<div class="form-group">';
            echo form_label('Subtitulo '.form_error('subtitulo', "<span class='text-danger'>", "</span>"), 'subtitulo');
            echo form_textarea(array('name' => 'subtitulo', 'value' => set_value('subtitulo'), 'class' => 'form-control', 'id' => 'subtitulo'));
        echo '</div>';
        echo '<div class="form-group">';
            echo form_label("Imagen de portada <span class='text-danger'>$errorImg</span>", 'subtitulo');
            echo form_upload(array('name' => 'imagen', 'value' => set_value('imagen'), 'class' => 'form-control-file', 'id' => 'imagen'));
        echo '</div>';
        echo '<div class="form-group">';
            echo form_label('Contenido de la noticia '.form_error('noticia', "<span class='text-danger'>", "</span>"), 'noticia');
            echo form_textarea(array('name' => 'noticia', 'value' => set_value('noticia'), 'class' => 'form-control', 'id' => 'noticia'));
        echo '</div>';
        echo form_submit(array('name' => 'submit', 'value' => 'Guardar', 'class' => 'btn btn-primary'));
    echo form_close();
    ?>
    <script>CKEDITOR.replace( 'noticia' );</script>
</div>