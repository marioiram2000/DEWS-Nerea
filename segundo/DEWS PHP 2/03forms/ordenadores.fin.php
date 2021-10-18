<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $componentes = explode("_", $_GET['seleccionados']);
            //print_r($componentes);
            echo "<h1>Tu selección:</h1>";
            for ($i = 0; $i < count($componentes); $i++) {
                echo "<p>$componentes[$i]</p>";
            }
        ?>
    </body>
</html>
