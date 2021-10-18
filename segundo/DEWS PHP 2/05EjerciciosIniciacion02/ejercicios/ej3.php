<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
        function sacarArticulos(){
            $f = fopen("../articulos.txt", "r");
            $arr = [];
            while(!(feof($f))){
                $linea = fgets($f);
                $partes = explode(";", $linea);
                $arr[$partes[0]] = $partes[1];
            }
            fclose($f);
            return $arr;
        }
        function setArticulo($nombre, $precio){
            $str = "\n".$nombre.";".$precio;
            $f = fopen("../articulos.txt", "a");
            fwrite($f, $str);
            fclose($f);
        }
        ?>
    </head>
    <body>
        <?php
        if(isset($_POST['submit'])){
            if($_POST['nombre']!="" && $_POST['precio']!="" ){
                setArticulo($_POST['nombre'], $_POST['precio']);
                if(is_uploaded_file($_FILES['archivo']['tmp_name'])){
                    $destino = "../".$_POST['nombre'].".txt";
                    move_uploaded_file($_FILES['archivo']['tmp_name'], $destino);
                }
            }
            
        }
        
        $articulos = sacarArticulos();
        $total = 0;
        
        if(isset($_GET['articulo'])){
            $total = $_GET['total']+$articulos[$_GET['articulo']];
        }
        
        
        ?>
        <table>
            <tr><th colspan="3">Elige tu pedido</th></tr>            
            <?php
            foreach ($articulos as $ariculo => $precio) {
                echo "<tr><td>$ariculo</td><td>$precio</td><td><a href='".$_SERVER['PHP_SELF']."?total=$total&articulo=$ariculo'>Añadir unidad</a></td></tr>";
            }
            ?>
            <tr><th colspan="3">Total: <?php echo $total?></th></tr>
        </table>
        <br><br>
        <table>
            <tr><th colspan="3">Añade articulo</th></tr> 
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                <tr>
                    <td><label>Nombre:</label></td><td><label>Precio(€)</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="nombre" value=""></td>
                    <td><input type="text" name="precio" value=""></td>
                    <td><input type="file" name="archivo" value=""></td>
                    <td><input type="submit" name="submit" value="AÑADIR"></td>
                </tr>                
            </form>
        </table>
        
    </body>
</html>
