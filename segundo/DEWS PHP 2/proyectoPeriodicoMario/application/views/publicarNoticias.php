<div class="col-10 my-3 ">
    <?php

    foreach ($noticias as $noticia) {
        $img = base_url().IMG.$this->m_periodico->getImgNoticia($noticia->id);
        $ruta = base_url()."index.php/c_noticias/noticia/".$noticia->id;
        echo "<div class='card w-75 mx-auto my-3 py-1 bg-light'>";
            echo "<img src='$img' alt='$noticia->titulo' class='rounded  d-block w-50 mx-auto' style=''height='400px'>";
            echo "<div class='card-body'>";
                echo "<h1 class='card-title'>$noticia->titulo</h1>";
                echo "<h3 class='card-text text-capitalize'>Autor: $noticia->nombre</h3>";
                echo "<h4 class='card-text'>$noticia->subtitulo</h4>";
                echo "<div>$noticia->contenido</div>";
            echo "</div>";
            echo '<div class="form-group mx-auto">';
            echo form_open(site_url()."/c_noticias/publicarNoticia/$noticia->id");
                echo form_dropdown('tipos', $tipos);
                echo form_submit(array('name' => 'submitPublicar', 'value' => 'Publicar noticia', 'class' => 'btn btn-primary'));
                echo form_submit(array('name' => 'submitBorrar', 'value' => 'Borrar noticia', 'class' => 'btn btn-danger'));
            echo form_close();
            echo "</div>";
        echo "</div>";
        
    }
    ?>
</div>