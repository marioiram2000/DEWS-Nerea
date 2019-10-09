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
            
            if(!isset($_SESSION['idlogin'])){
                header("location: login.php");
                exit();
            }else{
                $_SESSION['pedido']=array();
            }
            if(isset($_GET['aniadir'])){
                $_SESSION['pedido']=$_GET['idplato'];
            }
            if(isset($_GET['quitar'])){
                $indice = array_search($_GET['plato'], $_SESSION['pedido']);
                unset($_SESSION['pedido'][$indice]);
            }
            
            if(isset($_GET['grabar'])){
                $idpedido=grabarPedido($cn, $_SESSION['pedido'], $_SESSION['idlogin']);
                unset($_SESSION['pedido']);
                echo "Pedido $pedido grabado";
            }
            
            echo $_SESSION['idlogin'];
            $cn = conectarse();
            $todosPlatos= platos($cn);
            print_r($todosPlatos);
            
            echo 'TODOS LOS PLATOS:';            
            echo '<table>';
            foreach ($todosPlatos as $arrPlato) {
              echo '<tr>';
                echo "<td>".$arrPlato['nombre']."</td>";
                echo "<td>".$arrPlato['precio']."€</td>";
                echo "<td>".$arrPlato['calorias']." calorias</td>";
                $idplato=$arrPlato['idplato'];
                if(!in_array($idplato, $_SESSION['pedido'])){
                    echo "<td><a href='".$_SERVER['PHP_SELF']."?aniadir&idplato=$idplato'> AÑADIR </a></td>";
                }else{
                    echo "<td><a href='".$_SERVER['PHP_SELF']."?quitar&idplato=$idplato'> QUITAR </a></td>";
                }                       
              echo '</tr>';
            }
            echo '</table>';
            if(count($_SESSION['pedido'])>0){
                echo '<p><a href="'.$_SERVER['PHP_SELF'].'?grabar">PEDIR</a></p>';
            }
            
            
            
        ?>
    </body>
</html>
