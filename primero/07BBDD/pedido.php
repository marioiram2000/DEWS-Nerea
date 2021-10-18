<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         session_start();
         include_once 'bbdd.inc.php';
         $cn=conectarse();
         
         if (!isset($_SESSION['idlogin'])){
             header("location: login.php");
             exit();
         }
         
         
         if (isset($_GET['aniadir'])){
             $_SESSION['pedido'][]=$_GET['idplato'];
         }
         
         if (isset($_GET['quitar'])){
             $indiceBorrar=array_search($_GET['idplato'],$_SESSION['pedido']);
             unset($_SESSION['pedido'][$indiceBorrar]);
         }
         
         if (isset($_GET['grabar'])){
             $idpedido=grabarPedido($cn,$_SESSION['pedido'],$_SESSION['idlogin']);
             $_SESSION['pedido']=array();
             echo "Pedido $idpedido grabado";
         }
         
         
         echo "<p>".$_SESSION['idlogin']."</p>";
         print_r ($_SESSION['pedido']);
         echo "<hr/>";
         
         
         
         $todosplatos=platos($cn);
         
         echo "<table>";
         foreach ($todosplatos as $arrplato){
             
             echo "<tr>";
             echo "<td>".$arrplato['nombre']."</td>";
             echo "<td>".$arrplato['precio']." €</td>";
             echo "<td>".$arrplato['calorias']." calorias</td>";
             $idplato=$arrplato['idplato'];
             if (!in_array($idplato,$_SESSION['pedido']))
                echo "<td><a href='".$_SERVER['PHP_SELF']."?aniadir&idplato=$idplato'>AÑADIR</a></td>";
             else
                 echo "<td><a href='".$_SERVER['PHP_SELF']."?quitar&idplato=$idplato'>QUITAR</a></td>";
             echo "</tr>";
         }
         echo "</table>";
         
         if (count($_SESSION['pedido']>0))
            echo "<p><a href='".$_SERVER['PHP_SELF']."?grabar'>GRABAR PEDIDO</a></p>";
         
         
        ?>
    </body>
</html>
