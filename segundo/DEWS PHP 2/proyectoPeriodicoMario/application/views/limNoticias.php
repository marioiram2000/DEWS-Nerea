<div class="mx-auto col-10">
    <h3 class="mx-auto my-2 pl-5">Lamentablemente has alcanzado el limite de noticias que puedes ver.</h3>
    <h4 class="mx-auto my-2 pl-5">Para poder ver más, <a href="<?= site_url()."/c_registro/" ?>">registrate</a> o <a href="<?= site_url()."/c_login/index"?>">inicia sesión</a></h4>
    <h4 class="mx-auto my-2 mb-5 pl-5">Afortunadamente, puedes volver a consultar las noticais que ya has visto</h4>
    <?php

    foreach ($noticias as $noticia) {
        $img = base_url().IMG.$this->m_periodico->getImgNoticia($noticia->id);
        $ruta = base_url()."index.php/c_noticias/noticia/".$noticia->id;
        echo "<div class='card w-75 mx-auto my-3 py-1 bg-light'>";
            echo "<img src='$img' alt='$noticia->titulo' class='rounded  d-block w-50 mx-auto' style=''height='400px'>";
            echo "<div class='card-body'>";
            echo "<a href='$ruta' class='text-reset'>";
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

