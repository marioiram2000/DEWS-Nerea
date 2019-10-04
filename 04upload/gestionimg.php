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
        function nombre($ruta){
            $nombre = basename($ruta);      
            return $nombre;
        }
        
        
        function listado(){
            $arr =array();
            $carpe = opendir("img");
            
            while($entrada = readdir($carpe)){
                if($entrada!="." && $entrada!="..")
                $arr[]= "img/".$entrada;
                
                $entrada = readdir($carpe);
            }
            closedir($carpe);
            return $arr;
        }
        
        if(isset($_GET['borrar'])){
            unlink($_GET['borrar']);
        }
        
        $arr= listado();
        echo "<ul>";
        foreach($arr as $imagen){
            echo "<li>";
            echo "<a href='$imagen>'".basename($imagen)."</a>";  
            echo "<a href='".$_SERVER['PHP_SELF'].">'BORRAR</a>"; 
            echo "</li>";
        }
        echo "</ul>";
        
        
        
        
        
        ?>
    </body>
</html>
