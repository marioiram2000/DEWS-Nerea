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
        $factores = [2,3,4,5,6,7,8,9];
        $num = 8;
        $feedback="";
        
        if(isset($_POST['submit'])){
            $rtdoR = $_POST['rtdo'];
            $factorR = $_POST['factor'];
            if($rtdoR==($factorR * $num)){
                $feedback = "OK";
            }else{
                $feedback = "MAL. Resultado = ".$factorR * $num;
            }
        }
        
        echo '<table>';
        foreach ($factores as $factor) {
            $valor = '';
            if($factor==$factorR){
                
            }
            echo "<tr>";
                echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
                    echo "<td>$num x $factor</td>";
                    echo "<td><input type='text' name='rtdo'></td>";
                    if($feedback!="" && $factor==$factorR){                        
                        echo "<td>$feedback</td>";
                    }
                    echo "<td><input type='submit' name='submit' value='corregir'></td>";
                    echo "<input type='hidden' name='factor' value='$factor'>";
                    
                echo '</form>';
                
            echo "</tr>";
            
        }
        echo "</table>";
        ?>
    </body>
    
</html>
