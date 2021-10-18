<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['desc'])){
    header("location:entrada.php");
    exit();
}

if(isset($_POST['plato'])){
    $_SESSION['elecciones'][$_POST['tipo']]=$_POST['plato'];
}
$algunPlato = "disabled";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p><a href="pedidoplato.php?tipo=primero">Elegir primero</a></p>
        <p><a href="pedidoplato.php?tipo=segundo">Elegir segundo</a></p>
        
        
        <?php
        if(isset($_SESSION['elecciones']) && (count($_SESSION['elecciones'])>0)){
            $algunPlato = "";
            echo "<ul>";
            foreach ($_SESSION['elecciones'] as $tipo => $plato) {
                echo "<li>$tipo: $plato</li>";
            }
            echo "</ul>";
        ?>        
        <form method="POST" action="finpedido.php">
            <input type="submit" name="submitfinpedido" value="Finalizar pedido">
        </form>   
        <?php
        }
        ?>     
    </body>
</html>
