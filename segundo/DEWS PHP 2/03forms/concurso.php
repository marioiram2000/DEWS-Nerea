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
            $pregs = array(
                array("2+2", "4"),
                array("En que año estamos?", "2020"),
                array("Rio que pasa por vitoria", "Zadorra"),
                array("Raiz cuadrada de 25", 5),
            );
        ?>
    </head>
    <body>
        <?php
            $iPreg=0;
            $acertado = false;
            $rCorrecta = "";
            $aciertos = 0;
            
            if(isset($_POST['submit'])){
                $iPreg = $_POST['iPreg'];
                $aciertos = $_POST['aciertos'];
                
                if(strtolower($_POST['resp'])==strtolower($pregs[$iPreg][1])){
                    $acertado = true;
                    $aciertos ++;
                }else{
                    $rCorrecta = $pregs[$iPreg][1];
                }
                
                $iPreg ++;
                
                if($acertado){
                    echo "<p>Has acertado! vas $aciertos aciertos, son un total de ". count($pregs)." preguntas</p>";
                }else{
                    echo "<p>La respuesta correcta era $rCorrecta.  vas $aciertos aciertos, son un total de ". count($pregs)." preguntas </p>";
                }
            }
            
            
            if($iPreg < count($pregs)){
                echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
                echo "<label for='resp'>".$pregs[$iPreg][0]."</label>";
                echo "<input type='text' name='resp'/>";
                echo "<input type='hidden' name='iPreg' value='$iPreg'/>";
                echo "<input type='hidden' name='aciertos' value='$aciertos'/>";
                echo "<input type='submit' name='submit' value='Enviar'/>";
                echo "</form>";
            }else{
                echo "<p><a href='respuestas.php?aciertos=$aciertos&total=". count($pregs)."'>finalizar</a></p>";
            }            
            /*
            if($acertado && $iPreg>0){
                echo "<p>Has acertado!</p>";
            }else{
                echo "<p>La respuesta correcta era $rCorrecta </p>";
            }
            */
        ?>
        <table>
            
        </table>
    </body>
</html>
