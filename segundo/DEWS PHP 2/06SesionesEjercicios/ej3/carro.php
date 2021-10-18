<!DOCTYPE html>
<?php

session_start();
$productos = array("prod1"=>"10","prod2"=>"20","prod3"=>"30","prod4"=>"40","prod5"=>"50","prod6"=>"60");
if(!isset($_SESSION['cantidades'])){
    $_SESSION['cantidades'] = array();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $errores = array();
        $errorElegidos = "";
        if(isset($_POST['submitAniadir'])){
            if(isset($_POST['elegidos'])){
                for ($i = 0; $i < count($_POST['elegidos']); $i++) {
                    $p = $_POST['elegidos'][$i];
                    $c = $_POST["cantidad$p"];
                    if($c == 0){
                        $errores[] = $p;
                    }else{
                        if(!isset($_SESSION['cantidades'][$p]) || $_SESSION['cantidades'][$p]==0){
                            $_SESSION['cantidades'][$p] = intval($c);
                        }else{
                            $_SESSION['cantidades'][$p] = intval($_SESSION['cantidades'][$p]) + intval($c);
                        }
                    }
                    
                }
            }else{
                $errorElegidos = "No has seleccionado ningún producto";
            }
        }
        
        if(isset($_POST['submitVaciar'])){
            $_SESSION['cantidades'] = array();
        }
        
        if(isset($_POST['submitFormalizar'])){
            $total = 0;
            echo "<h2>TU PEDIDO</h2><ul>";
            foreach ($_SESSION['cantidades'] as $producto => $cantidad) {
                $precio = $productos[$producto];
                echo "<li>$producto - $cantidad unidades - $precio € unidad - total ".$precio*$cantidad."</li>";
                $total += $precio*$cantidad;
            }
            echo '</ul>';
            echo "<h3>TOTAL: $total</h3>";
        }
        
        
        echo "<p style='color:red;'>$errorElegidos</p>";
        ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
            <table>
                <tr><th>PRODUCTO</th><th>PRECIO</th><th>ELIJA CANTIDAD</th><th>PEDIDO ACTUAL</th></tr>                
                <?php
                foreach ($productos as $producto => $precio) {
                    echo "<tr><td><input type='checkbox' name='elegidos[]' value='$producto'>$producto</td>";
                    echo "<td>$precio</td>";
                    echo "<td><select name='cantidad$producto'>";
                    for ($i = 0; $i <= 10; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    echo "</select></td>";
                    if(isset($_SESSION['cantidades'][$producto])){
                        if(in_array($producto, $errores)){
                            echo "<td>".$_SESSION['cantidades'][$producto]."  uds pedidas <span style='color:red;'>No has seleccionado ninguna unidad</span></td></tr>";
                        }else{
                        echo "<td>".$_SESSION['cantidades'][$producto]."  uds pedidas</td></tr>";
                        }
                    }else{
                        if(in_array($producto, $errores)){
                            echo "<td>0 uds pedidas <span style='color:red;'>No has seleccionado ninguna unidad</span></td></tr>";
                        }else{
                            echo "<td>0 uds pedidas</td></tr>";
                        }
                    }
                }
                ?>
            </table>
            <input type="submit" name="submitAniadir" value="AÑADIR UNIDADES">
            <input type="submit" name="submitFormalizar" value="FORMALIZAR COMPRA">
            <input type="submit" name="submitVaciar" value="VACIAR CARRO">
        </form>
        
    </body>
</html>
