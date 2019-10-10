<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    include_once 'bbdd.inc.php';
    $cn=conectarse();
    $clientes = clientes($cn);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            if(isset($_POST['modificar'])){
                echo 'ENTRA A MODIFICAR -- DNI:'.$_POST['dni'];
                if(modificarDatos($cn, $_POST['nombre'], $_POST['apellidos'], $_POST['dni'])){
                    echo "-------------MODIFICADO-----------";
                }else{
                    echo "----------------NO------------";
                }
            }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Cantidad de pedidos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($clientes as $cliente) {
                        //$url =$_SERVER['PHP_SELF']."?".$cliente['dni'];
                        $url = "";
                        $contPedidos = contarPedidos($cn, $cliente->dni);
                        echo "<input type='hidden' name='dni' value='".$cliente->dni."'";
                        echo "<tr>";
                            echo "<td><input type='text' name='nombre' value='".$cliente->nombre."'/></td>";
                            echo "<td><input type='text' name='apellidos' value='".$cliente->apellidos."'/></td>";
                            echo "<td><a href='$url'>". $contPedidos." pedidos</a></td>";
                            echo "<td><input type='submit' name='modificar' value='MODIFICAR'/></td>";
                        echo "</tr>";
                    }
                    
                    ?>
                </tbody>
            </table>

        </form>
        
        
        
    </body>
</html>
