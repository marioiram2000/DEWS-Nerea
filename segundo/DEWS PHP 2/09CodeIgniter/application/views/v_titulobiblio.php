<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>
            <?php 
            if(isset($cantAutores)){
                echo $titulo." (".$cantAutores." autores y ". $cantLibros." libros)";
            }else{
                echo $titulo." ( LIBROS DEL AUTOR ".$autor['nombre'].")";
            }
            ?></h1>