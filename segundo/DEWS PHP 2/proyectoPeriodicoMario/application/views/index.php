<div class="col-10 my-3 ">
    <?php

    foreach ($noticias as $noticia) {
        $img = base_url().IMG.$this->m_periodico->getImgNoticia($noticia->id);
        $ruta = base_url()."index.php/c_noticias/noticia/".$noticia->id;
        echo "<div class='card w-75 mx-auto my-3 py-1 bg-light'>";
            echo "<img src='$img' alt='$noticia->titulo' class='rounded  d-block w-50 mx-auto w-75'>";
            echo "<div class='card-body'>";
            echo "<a href='$ruta' class='text-reset text-decoration-none'>";
                echo "<h1 class='card-title'>$noticia->titulo</h1>";
                echo "<h4 class='card-text'>$noticia->subtitulo</h4>";
            echo "</a>";
            echo "<p class='card-text text-right my-0'><small class='text-muted text-capitalize'>autor: $noticia->nombre</small></p>";
            echo "<p class='card-text text-right my-0'><small class='text-muted text-capitalize'>fecha: ".date("d-m-Y", strtotime($noticia->fecha))." </small></p>";
            echo "</div>";
        echo "</div>";
    }
    ?>
</div>