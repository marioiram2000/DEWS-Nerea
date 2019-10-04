<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    session_start();
    
    if(!isset($_POST['finalizar'])){
        header("Location: pedido.php");
    }
    function sacarPrecio($plato){
        return intval(explode(" ", $plato)[2]);
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            if(isset($_SESSION['usuario'])){
                echo "<p>Hola ".$_SESSION['usuario'].", hoy has elegido esto:<p>";
                $descuento = $_SESSION['descuento'];
            }else{
                echo "<p>Has elegido esto:<p>";
            }
            $total = 0;
            if(isset($_SESSION['primero'])){
                
                $total += sacarPrecio($_SESSION['primero']);
                echo "<li>Primer plato: ".$_SESSION['primero']."</li>";
            }
            if(isset($_SESSION['segundo'])){
                $total += sacarPrecio($_SESSION['segundo']);                
                echo "<li>Segundo plato: ".$_SESSION['segundo']."</li>";
            }
            if(isset($_SESSION['postre'])){
                $total += sacarPrecio($_SESSION['postre']);       
                echo "<li>Postre: ".$_SESSION['postre']."</li>";
            }
            echo "La cuenta sale a $total €";
            if(isset($descuento)){
                $final = $total - $total*$descuento/100;
                echo "<br><strong>Tras aplicar su descuento, se queda en $final €</strong>";
            }
            
        ?>
    </body>
</html>
