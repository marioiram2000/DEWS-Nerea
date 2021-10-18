<div class="col-6 my-3  mx-auto border border-dark rounded" style="background-color: ffffea;">
    <?php
    $img = base_url().IMG.$noticia->ruta;
    echo "<h1 class='text-center py-3'>$noticia->titulo</h1>";
    echo "<h2>". html_entity_decode($noticia->subtitulo)."</h2>";
    echo "<img src='$img' alt='$noticia->titulo' height='400px' class='d-block mx-auto my-5'>";
    echo $noticia->contenido;
    ?>
</div>