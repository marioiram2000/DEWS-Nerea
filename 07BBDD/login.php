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
            
            
            //SUBMIT AÑADIR CLIENTE
            $error_aniadir_cliente="";
            if (isset($_POST['submitnuevocliente'])){
                if (!aniadir_cliente($cn,$_POST['dni'],$_POST['nombre'],$_POST['apellidos']))
                        $error_aniadir_cliente="Cliente ya existente";
            }
            //SUBMIT LOGIN
            if (isset($_POST['submitlogin'])){
                $_SESSION['idlogin']=$_POST['idcliente'];
                $_SESSION['pedido']=array();
                header("location: pedido.php");
                exit();
            }
            
            
            $todosclientes=clientes($cn);
                    
            echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
            echo "<select name='idcliente'>";
            foreach ($todosclientes as $cliente)  //$cliente es objeto con props nombre, apellidos, etc
            {        
                echo "<option value='".$cliente->dni."'>".
                        $cliente->nombre ." " . $cliente->apellidos ."</option>";
            }
            echo "</select>";
            echo "<input type='submit' name='submitlogin' value='ENTRAR' />";
            echo "<br/>";
            echo "<p>CLIENTE NUEVO</p>";
            echo "DNI: <input type='text' name='dni' />";
            echo "Nombre: <input type='text' name='nombre' />";
            echo "Apellidos: <input type='text' name='apellidos' />";
            echo "<input type='submit' name='submitnuevocliente' value='Añadir cliente' />";
            echo $error_aniadir_cliente;
            
            echo "</form>";
        ?>
        
     
    </body>
</html>
