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
        $imags=array("casa.jpg","flor.jpg","llama.jpg");
        ?>
        <table>
            <?php
                for($i=0; $i<count($imags); $i++){
                    $ruta="imagenes/".$imags[$i];
                    echo "<tr>";        
                        echo"<td>";
                            echo "<img src='$ruta' height='100'>";
                            
                        echo"</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>
