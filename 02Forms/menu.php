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
            $menu = array(
              "primero" => array ("Alubias", "Pasta", "Arroz","Ensalada", "Sopa", "Pure"),
              "segundo" => array ("Filete", "Hamburguesa", "Salmon","Pencas rellenas", "Merluza", "Berenjena a la plancha"),
              "postre" => array ("Goxua", "Flan", "Arroz con leche","Yogur", "Helado", "Natillas")
            );
            $orden = array_keys($menu);
            $iactual=0;
            
            $elegido = "";
        ?>
        <?php if(isset($_POST['submit'])){
            $elegido = $_POST["elegido"];
            $iactual = $_GET["iactual"]+1;
            $elegido .= " ".$_POST['plato'];
        }
        ?>
        <?php $enlace=$_SERVER['PHP_SELF']."?iactual=".$iactual; ?>
        <form method="post" action="<?php echo $enlace ?>">
            <?php if ($iactual < count($orden)){ ?>
            <p>
                Elige tu <?php echo $orden[$iactual]?>
                <select name="plato">
                    <?php 
                    $opciones = $menu[$orden[$iactual]];
                    foreach ($opciones as $plato) {
                        echo "<option value='$plato'>$plato</option>";
                    }
                    ?>
                   
                </select>
                
            </p>
            <p><input type="submit" name="submit" value="ELEGIR"></p>
            
            <input type="hidden" name="elegido" value="<?php echo $elegido?>">
            <?php }
            else{
                echo "<p>";
                echo "Su elección ha sido la siguiente: ";
                echo "</p>";
                $elegido = trim($elegido);
                $arr = explode(" ", $elegido);
                echo "<ul>";
                foreach ($arr as $value) {
                   echo "<li>";
                    echo $value;
                    echo "</li>"; 
                }
                echo "</ul>";
                echo "<p>Esperamos que lo disfrute</p>";
                
                
            }
            ?>
        </form>
            
    </body>
</html>
