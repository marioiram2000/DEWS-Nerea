<!DOCTYPE html>
<?php
session_start();
include 'libmenu.php';

if(!isset($_SESSION['desc']) || !isset($_GET['tipo'])){
    header("location:entrada.php");
    exit();
}

$platos = damePlatos($_GET['tipo']);
$elegido="";

if(isset($_SESSION[$_GET['tipo']])){
    $elegido="Va a cambiar su eleccion de ".$_SESSION[$_GET['tipo']];
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p><?php echo $elegido?></p>
        <form method="POST" action="pedido.php">
            <select name="plato">
                <?php
                foreach ($platos as $plato => $precio) {
                    echo "<option value='$plato'>$plato - $precio €</option>";
                }
                ?>
            </select>
            <input type="hidden" name="tipo" value="<?php echo $_GET['tipo'] ?>">
            <input type="submit" name="submitPlato" value="Elegir <?php echo $_GET['tipo'] ?>">
        </form>
        
    </body>
</html>
