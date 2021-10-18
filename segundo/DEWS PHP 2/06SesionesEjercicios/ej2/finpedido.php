<!DOCTYPE html>
<?php
session_start();
include 'libmenu.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $total = 0;
        foreach ($_SESSION['elecciones'] as $tipo => $plato) {
            $precio = damePrecio($plato);
            $total += $precio;
            echo "<li>$tipo: $plato -> $precio €</li>";
        }
        echo "<p>Total: $total €</p>";
        if(isset($_SESSION['desc'])){
            $total = $total - ($total*($_SESSION['desc']/100));
            echo "<p>".$_SESSION['usu'].", tras aplicar su descuento del ".$_SESSION['desc']."%, se queda en un total de: $total €</p>";
        }
        
        ?>
    </body>
</html>
