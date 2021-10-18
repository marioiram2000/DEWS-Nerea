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
        $alumnos = array("salama", "mario", "ibai", "jon", "unai");
        $alumnos[] = "unai";
        $alumnos[] = "ander";
        
        for ($i = 0; $i < count($alumnos); $i++) {
            echo "Indice $i: ". $alumnos[$i]. "<br>";
        }
        
        
        $temps = array("L"=>30, "M"=>29, "X"=> 32);
        $temps["J"] = 30;
        $temps["V"] = 33;
        
        foreach ($temps as $d => $t) {
            echo "<p>$d -> $t º</p>";
        }
        
        $saludo = "Buenos dias";
        $cont = 1;
        for ($index = 0; $index < strlen($saludo); $index++) {
            if($cont%2 == 0){
                echo "<span style='color:red'>".$saludo[$index]."</span>";
            }else{
                echo "<span>".$saludo[$index]."</span>";
            }
            
            $cont ++;
        }
        
        
        ?>
    </body>
</html>
