<div id="container">
    <div id="bar">
        <p>CATEGORIAS</p>
        <ul>
            <?php
             $todasCategorias = sacarCategorias($cn);
             echo "<li><a href='index.php?id_cat=todas'>Ver todas</a></li>";
             foreach ($todasCategorias as $categoria) {
                 $id_cat=$categoria->id;
                 echo "<li><a href='index.php?id_cat=$id_cat'> $categoria->categoria </a></li>";
             }
            ?>
        </ul>
    </div>