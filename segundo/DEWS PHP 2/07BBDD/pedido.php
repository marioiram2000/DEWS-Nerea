<?php
    require 'bbdd.php';
    $con = conexion();
    session_start();
    
    if(!isset($_SESSION['idcleinte']))
    
    if(!isset($_SESSION['pedido'])){
        $_SESSION['pedido'] = array();
    }
    
    if(isset($_POST['submitpedir'])){
        $idalimento = $_POST['idalimento'];
        if(array_key_exists($idalimento, $_SESSION['pedido'])){
            $_SESSION['pedido'][$idalimento] ++;
        }else{
            $_SESSION['pedido'][$idalimento] = 1;
        }
    }
    
    if(isset($_GET['formalizar'])){
        $precioTotal=0;
        foreach ($_SESSION['pedido'] as $idalimento => $ctd) {
            $precioTotal += $ctd * getPrecio($idalimento, $con);
        }
        $idpedido= nuevoPedido($con, $_SESSION['idcliente'], $precioTotal);
        echo "<p>Generado pedido con identificador: $idpedido</p>";
        $_SESSION['pedido'] = array();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $alims = alimentos2($con);
        echo "<table>";
        
        foreach ($alims as $alim) {
        echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
        echo "<tr>";
            echo "<td>".$alim->nombre."</td>";
            echo "<td>".$alim->precio."</td>";
            echo "<td><input type='hidden' name='idalimento' value='$alim->id'></td>";
            echo "<td><input type='submit' name='submitpedir' value='Añadir unidad'></td>";
            if(array_key_exists($alim->id, $_SESSION['pedido'])){
                echo "<td>";
                echo $_SESSION['pedido'][$alim->id]. "uds.";
                echo "</td>";
            }
            
        echo "</tr>";
        echo "</form>";
        }    
        
        echo "</table>";
        echo "<p><a href='".$_SERVER['PHP_SELF']."?formalizar"."'>Formalizar predido</a></p>";
        ?>
        
            
        
    </body>
</html>
