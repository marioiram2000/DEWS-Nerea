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
            if(isset($_POST['pedir'])){
                if(!isset($_SESSION['pedido'])){
                    $_SESSION['pedido'] = array();
                }else{
                    $producto = [$_POST['prod'],$_POST['cant']];
                    $_SESSION['pedido'][] = $producto;
                }
            }
            /*
             * 
             * pasar por hiden el nombre
             * 
             * 
             * 
             */
        ?>
        
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                Patatas <input type="text" name="cant">
                <input type="submit" name="pedir" value="pedir">
            </form>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                Bocatas
                <input type="text" name="cant">
                <input type="submit" name="pedir" value="pedir">
            </form>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                Refrescos
                <input type="text" name="cant">
                <input type="submit" name="pedir" value="pedir">
            </form>
        
        <?php 
            if(isset($_SESSION['pedido'])){
                foreach ($_SESSION['pedido'] as $producto) {
                    $nombre = $producto[0];
                    $cantidad = $producto[1];
                    echo "<p>$nombre: $cantidad unidades";
                }
            }
        ?>
    </body>
</html>
