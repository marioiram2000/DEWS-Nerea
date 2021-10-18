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
        $ciudades = array("madrid", "vitoria", "bilbo", "vitoria", "agurain", "barcelona", "madrid");
        $aux = array_unique($ciudades);
        
        echo "<ol>";
        foreach ($aux as $ciudad) {
            echo "<li>$ciudad</li>";   
        }
        echo "</ol>";
        ?>
    </body>
</html>
