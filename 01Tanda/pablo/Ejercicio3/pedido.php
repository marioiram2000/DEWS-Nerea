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
            $arrarticulos=array();
            $total=0;
            function lista_articulos()
            {
              $f= fopen("articulos.txt", 'r');
              while(!feof($f))
              {
                  $linea= fgets($f);
                  $lineasep= explode(";", $linea);
                  $arrarticulos[$lineasep[0]]=$lineasep[1];
              }
              
              return $arrarticulos;
              fclose($f);
            }
            
            function aniadir_a_fich($nombre,$precio)
            {
                $f=fopen("articulos.txt",'a');
                
                $cadena="\n".$nombre.";".$precio;
                fputs($f, $cadena);
                fclose($f);
            }
            
            if (isset($_GET['precio']))
            {
                $total=$_GET['total'];
                $total=$total+$_GET['precio'];
            }
            
            if (isset($_POST['add_art']))
            {
                aniadir_a_fich($_POST['nombre'],$_POST['precio']);
                if(is_uploaded_file($_FILES['upload']['tmp_name']))
                {
                    move_uploaded_file($_FILES['upload']['tmp_name'], $_POST['nombre'].".txt");
                    echo "<p>archivo subido</p>";
                }
                else
                    echo "<p>No se pudo subir</p>";
            }
        ?>
        
        <h2>ELIGE TU PEDIDO</h2>
        <table>
            <?php
                $arrarticulos=lista_articulos();
                foreach($arrarticulos as $articulo=>$precio)
                {
                    echo "<tr>";
                        echo "<td>$articulo</td>";
                        echo "<td>$precio €</td>";
                        echo "<td><a href='".$_SERVER['PHP_SELF']."?precio=".$precio."&total=".$total."'>Añadir unidad</a></td>";
                    echo "</tr>";
                }
                    echo "<tr>";
                        echo "<td colspan=3 align=center><b>Total: $total €</b></td>";
                    echo "</tr>";
            ?>
        </table>
        
        <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
            <input type="hidden" name="total" value="<?php $total ?>"/>
            Nombre:<input type="text" name="nombre" value=""/>
            Precio(€):<input type="text" name="precio" value=""/>
            Añadir archivo:<input type="file" name="upload"/>
            <input type="submit" name="add_art" value="AÑADIR"/>
        </form>
    </body>
</html>
