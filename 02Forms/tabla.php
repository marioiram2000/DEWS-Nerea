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
    
        <form action=<?php echo $_SERVER['PHP_SELF']?> method="POST">
            <?php
            $filas="";
            $columnas="";
            $color="";
            //Erores
            $error_filas='';
            $error_columnas='';
            $error_color = '';
            if(isset($_POST['submit'])){
                 
                if(empty($_POST['filas'])){
                    $error_filas='Faltan filas';
                }else{
                    $filas = $_POST['filas'];
                }
                if(empty($_POST['columnas'])){
                    $error_columnas='Faltan columnas';
                }else{
                    $columnas = $_POST['columnas'];
                }
                if (!isset($_POST['color'])){
                    $error_color = 'falta color';
                }//else{
                 //   switch($_POST['color'])){
                 //       case 'red': $
                 //  } 
                //}
                  
                $filas = $_POST['filas'];
                $columnas = $_POST['columnas'];
                $color = $_POST['color'];
                
                
                echo "<table bgcolor='".$color."' border = 1>";
                for ($i = 0; $i < $filas; $i++) {
                    echo "<tr>";
                    for ($j = 0; $j < $columnas; $j++) {
                        echo "<td>";
                        echo "hola";
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
            ?>
            <p>Filas: <input type='text' name='filas' value=""/><?php echo $error_filas; ?></p>
            <p>Columnas: <input type='text' name='columnas'/><?php echo $error_columnas; ?></p>
           
            <p>Rojo     <input type="checkbox" name="color" value="red"/></p>
            <p>Azul     <input type="checkbox" name="color" value="blue"/></p>
            <p>Verde    <input type="checkbox" name="color" value="green"/></p>
             <?php echo $error_color; ?>
            
            <p><input type="submit" name="submit" value="Dibujar"/></p>
            
        </form>
        
        
        
    
</html>
