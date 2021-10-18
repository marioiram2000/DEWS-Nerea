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
            $err_ini = '';
            $err_cant = '';
            $err_tipo = '';
            
            $ini = '';
            $cant = '';
            $tipo = '';
            
            if(isset($_POST['submit'])){
                
                if(empty($_POST['n_ini'])){
                    $err_ini = "Introduce un numero";
                }else{
                    $ini = $_POST['n_ini'];
                }
                
                if(empty($_POST['n_cant'])){
                    $err_cant = "Introduce un numero";
                }else{
                    $cant = $_POST['n_cant'];
                }
                
                if(!isset($_POST['tipo'])){
                    $err_tipo = 'Seleccione un tipo';
                }else{
                    switch ($_POST['tipo']) {
                        case "aritmetica": $tipo = "aritmetica";
                            break;
                        
                        case "geometrica": $tipo = "geometrica";
                            break;
                    }
                }
            }
        ?>
        <?php
        if (isset($_POST['submit']) && ($err_cant == "" && $err_ini == "" && $err_tipo == "")){
            $cambio = $_POST['cambio'];
            $aux = $ini;
            echo "<h1>".$cant."</h1>";
            if($tipo=="aritmetica"){
                
                for ($i = 0; $i < $cant; $i++) {
                    echo $aux." ";
                    $aux +=  $cambio;
                }
            }
            if($tipo == "geometrica"){
                 
                for ($i = 0; $i < $cant; $i++) {
                    echo $aux."  ";
                    $aux *= $cambio;
                }
            }
        }
        ?>
        <form action=<?php echo $_SERVER['PHP_SELF']?> method="POST">
            <p>Nº inicio <input type='text' name='n_ini' value="<?php echo $ini; ?>"/><?php echo $err_ini?></p>
            <p>Cantidad de numeros <input type='text' name='n_cant' value="<?php echo $cant; ?>"/><?php echo $err_cant?></p>
            <p>Cambio
                <select name="cambio">
                    <?php 
                    for ($index = 1; $index <= 10; $index++) {
                        echo "<option value='$index'>$index</option>";
                    }
                    ?>
                </select>
            </p>
            <p>Tipo de serie: <?php echo $err_tipo?></p>
            <p>aritmetica<input type="radio" name="tipo" value="aritmetica"/></p>
            <p>geometrica<input type="radio" name="tipo" value="geometrica"/></p>
            
            <p><input type="submit" name="submit" value="Calcular"/></p>
        </form>
    </body>
</html>
