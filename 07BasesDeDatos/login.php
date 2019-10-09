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
            $cn = conectarse();
            $err_aniadir_cliente = "";
            
            if(isset($_POST['submitNuevoCliente'])){
                if(!aniadir_cliente($cn, $_POST['dni'],$_POST['nombre'],$_POST['apellidos'])){
                    $err_aniadir_cliente = "Error al añadir el cliente";
                }
            }
            
            if(isset($_POST['submitLogin'])){
                $_SESSION['idlogin']=$_POST['idcliente'];
                $_SESSION['pedido']=array();
                header("location: pedido.php");
                exit();
            }
            
            
            $todosClientes = clientes($cn);
                                 
            echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
                echo "<select name='idcliente'>";
                echo"CLIENTES ACTUALES:";
                foreach ($todosClientes as $cliente) {//$cliente es objeto con nombre, apellidos...
                    echo "<option value='".$cliente->dni."'>".$cliente->nombre."  ".$cliente->apellidos."</option>";
                }
                echo "</select>";
                echo "<input type='submit' name='submitLogin' value='Enviar'>";
                echo "<br>";
                echo '<p>CLIENTE NUEVO</p>';
                echo "DNI:<input type='text' name='dni'><br>";
                echo "Nombre:<input type='text' name='nombre'><br>";
                echo "Apellidos:<input type='text' name='apellidos'><br>";
                echo "<input type='submit' name='submitNuevoCliente' value='AÑADIR CLIENTE'>";
                echo $err_aniadir_cliente;
            echo "</form>";
        ?>
        
    </body>
</html>
