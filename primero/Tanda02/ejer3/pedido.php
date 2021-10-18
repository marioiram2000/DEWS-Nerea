<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    session_start();
    
    if(isset($_POST["platoElegido"])){
        $_SESSION[$_POST['tipoPlato']]=$_POST['platos'];
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="finpedido.php">
            <p><a href="pedidoplato.php?tipo=primero">PRIMER PLATO</a></p>
            <p><a href="pedidoplato.php?tipo=segundo">SEGUNDO PLATO</a></p>
            <p><a href="pedidoplato.php?tipo=postre">POSTRE</a></p>
            <?php 
                $elegido = false;
                if(isset($_POST['platoElegido'])){
                    echo "<p>SU ELECCION:</p><ul>";
                    if(isset($_SESSION['primero'])){
                        $elegido = true;
                        echo "<li>Primer plato: ".$_SESSION['primero']."</li>";
                    }
                    if(isset($_SESSION['segundo'])){
                        $elegido = true;
                        echo "<li>Segundo plato: ".$_SESSION['segundo']."</li>";
                    }
                    if(isset($_SESSION['postre'])){
                        $elegido = true;
                        echo "<li>Postre: ".$_SESSION['postre']."</li>";
                    }


                }
                echo "</ul>";
                if($elegido){
                    echo '<input type="submit" name="finalizar" value="FINALIZAR PEDIDO">';
                }
            ?>
            
        </form>
    </body>
</html>
