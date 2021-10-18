<div class="col-6 my-3  mx-auto border border-dark rounded" style="background-color: ffffea;">
    <?php
    $img = base_url().IMG.$noticia->ruta;
    echo "<h1 class='text-center py-3'>$noticia->titulo</h1>";
    echo "<h2>$noticia->subtitulo</h2>";
    echo "<img src='$img' alt='$noticia->titulo' class='d-block mx-auto my-5 w-100'>";
    echo $noticia->contenido;
    ?>
</div>