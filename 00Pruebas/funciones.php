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
         <?php
        function perfecto($num){
            $suma_divs=0;
           for($div=1;$div<$num; $div++){
               if($num % $div == 0){
                   echo"Perfeco";
               }else{
                   echo"no perfecto";
               }
           }
        }
        ?>
    </head>
    <body>
       
    </body>
</html>
