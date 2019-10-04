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
        include_once 'fich.inc.php';
        
        $arr=listado("usuarios.txt");
        if (!$arr)
            echo "<p>Fichero inexistente</p>";
        else{            
            foreach ($arr as $usuario=>$clave){
                  echo "<p>$usuario - $clave</p>"; 
            }
        }
        
        ?>
    </body>
</html>
