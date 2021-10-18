<?php
require 'bbdd.php';
$link = conexion();
session_start();



if(isset($_GET['verPedidos'])){
    $idcliente = $_GET['verPedidos'];
    $pedidos = getPedidosCliente($link, $idcliente);
}

if(isset($_POST['submit'])){
    if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
        setImgCliente($link, $_POST['idcliente'], "imagenes/".$_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], "imagenes/".$_FILES['imagen']['name']);
    }
}

$clientes = getClientes($link);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
            <tr><th>Cliente</th><th>Pedidos</th><th></th></tr>
            <?php
            foreach ($clientes as $cliente) {
                echo "<tr>";
                    echo "<td>".$cliente['nombre']."</td>";
                    echo "<td>";
                    if(isset($_GET['verPedidos']) && $_GET['verPedidos'] == $cliente['idcliente']){
                        if(isset($pedidos) && $pedidos != array()){
                            echo "<ul>";
                            foreach ($pedidos as $pedido) {
                                echo "<li>".$pedido['preciototal']."€</li>";
                            }
                            echo "</ul>";
                        }else{
                            echo "ese usuario no tiene ningun pedido";
                        }
                    }else{
                        echo "<a href='".$_SERVER['PHP_SELF']."?verPedidos=".$cliente['idcliente']."'>Ver pedidos</a>";
                    }
                    
                    echo "</td>";
                    
                    if(isset($cliente['imagen'])){
                        echo "<td><img src='".$cliente['imagen']."' width='300px'/></td>";
                    }else{
                        echo "<td><img src='' alt='este usuario no tiene imagen'/></td>";
                    }
                    
                    echo "<td>";
                        echo "<form method='POST' action='".$_SERVER['PHP_SELF']."' enctype='multipart/form-data'>"
                                . "<input type='file' name='imagen'/><input type='submit' name='submit' value='Subir imagen'/>"
                                . "<input type='hidden' name='idcliente' value='".$cliente['idcliente']."'>"
                                . "</form>";
                    echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </body>
</html>
