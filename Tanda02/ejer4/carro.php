<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start();?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $nombrePrecio = array("patatas"=>"1","cafe"=>"0.79","bocata"=>"1.09","napolitanas"=>"1");
            
            if(isset($_POST["aniadir"])){
                foreach ($nombrePrecio as $nombre => $precio) {
                    if(isset($_POST[$nombre])){
                        $cantidad = $_POST["cantidad".$nombre];
                        $_SESSION['pedido'][$nombre]=$cantidad;
                    }
                }
            }
            
            if(isset($_POST["vaciar"])){
                foreach ($nombrePrecio as $nombre => $precio) {
                    $_SESSION['pedido'][$nombre]=0;
                }
            }
            
            if(isset($_POST["formalizar"])){
                $total = 0;
                foreach ($_SESSION['pedido'] as $nombre => $cantidad) {
                    $precio = $nombrePrecio[$nombre];
                    $precioTotal = intval($precio)*intval($cantidad);
                    echo $nombre." cantidad: ".$cantidad." precio unitario:". $precio."€ precio: ".$precioTotal."€<br>";
                    $total += $precioTotal;
                }
                echo 'Total de la compra: '.$total."€";
            }
        ?>
        <form>
            <table>
                <tr>
                    <th>PRODUCTO</th>
                    <th>PRECIO</th>
                    <th>ELIJA CANTIDAD</th>
                    <th>PEDIDO ACTUAL</th>
                </tr>
                <tr>
                    <?php 
                    foreach ($nombrePrecio as $nombre => $precio) {
                        if(!isset($_SESSION['pedido'][$nombre])){
                            $_SESSION['pedido'][$nombre]=0;
                        }
                        $unidades = $_SESSION['pedido'][$nombre];
                        echo '<tr>';
                            echo '<td><input type="checkbox" name="'.$nombre.'" value="'.$nombre.'">'.$nombre.'</td>';
                            echo "<td>$precio €</td>";
                            echo "<td>";
                                $selectCantidad = "cantidad".$nombre;
                                echo "<select name='$selectCantidad'>";
                                    for ($i = 0;$i < 11;$i++) {
                                        echo "<option value=$i>$i</option>";
                                    }
                                echo "</select>";
                            echo "</td>";
                            echo "<td>".$unidades." uds pedidas</td>";
                        echo "</tr>";
                    }
                    ?>
                
            </table>
            <p>
                <input type="submit" name="aniadir" value="AÑADIR UNIDADES">
                <input type="submit" name="formalizar" value="FORMALIZAR COMPRA">
                <input type="submit" name="vaciar" value="VACIAR CARRO">
           </p>
        </form>
    </body>
</html>
