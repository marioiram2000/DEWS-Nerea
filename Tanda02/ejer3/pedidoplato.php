<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include 'libmenu.php';
            $tipo = $_GET['tipo'];
            $platos = damePlatos($tipo);
        ?>
        <form method="POST" action="pedido.php">
            <?php
                if(isset($_SESSION[$tipo])){
                    $nombre = explode(" ", $_SESSION[$tipo])[0];
                    echo "<p>Va a cambiar su eleccion $nombre por:</p>";
                }else{
                    echo "<p>Elige tu $tipo</p>";
                }
                
            ?>
            <select name="platos">
                <?php
                    foreach ($platos as $plato => $precio) {
                        echo "<option>$plato - $precio €</option>";
                    }
                ?>
            </select>
            <input type="hidden" name="tipoPlato" value="<?php echo $tipo ?>">
            <input type='submit' name='platoElegido' value='Elegir <?php echo $tipo ?> '>
        </form>
    </body>
</html>
