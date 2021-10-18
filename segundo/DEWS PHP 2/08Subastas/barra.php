<?php
$categorias = getCategorias($link);
?>
<h1>CATEGORIAS</h1>
<ul>
    <li><a href="index.php">Ver todas</a></li>
    <?php
    foreach ($categorias as $categoria) {
        echo "<li><a href='index.php?categoria=".$categoria['id']."'>".$categoria['categoria']."</a></li>";
    }
    ?>
</ul>