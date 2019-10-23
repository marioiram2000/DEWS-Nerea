<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8"  http-equiv="refresh" content="2">
        <title></title>
    </head>
    <body>
        <?php
            $f= fopen("charla.txt", 'r');
            while(!feof($f))
            {
                $linea= fgets($f);
                echo $linea."<br>";
            }
            fclose($f);
        ?>
    </body>
</html>
