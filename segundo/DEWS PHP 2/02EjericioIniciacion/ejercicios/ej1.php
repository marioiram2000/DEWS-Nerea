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
            
            $fechaActual = date("d F Y");
            echo "<p> Estamos a ".$fechaActual."</p>";
            
            //
            $finAnio = strtotime("2020/12/31");
            $dias = (int)(($finAnio - time())/(60*60*24));
            
            echo "<p>Quedan $dias dias para que acabe el año</p>";
            //
            
            $frase = array("Hola", "que", "tal", "estas?");
            echo "<p>";
            foreach ($frase as $pal) {
                echo "$pal ";
            }
            echo "</p>";
            
            //
            
            $palabra = "moñoño";
            $resul = str_replace("ñ", "gn", $palabra);
            
            echo "<p>$resul</p>";
                        
            //
            
            function arrayAleatorio($min, $max, $n) {
                $array = array();
                for ($i = 0; $i < $n; $i++) {
                    $array[$i] = rand($min, $max);
                }
                return $array;
            }
            
            echo "<p>". print_r(arrayAleatorio(10, 60, 10)). "</p>";
            
            //
            
            function cifrar($str){
                $aux = "";
                $claves = array("a"=>"asce","b"=>"rfdsvds","c"=>"ytnynrt","d"=>"ymgfhf","e"=>"23rdeaf4","f"=>"fgrtg5hgf","g"=>"x","h"=>"x","i"=>"x","j"=>"x","k"=>"x","l"=>"x","m"=>"x","n"=>"n","ñ"=>"f2t424","o"=>"13reewf","p"=>"2gsrg","q"=>"mmtf","r"=>"2t34gf24gfhty","s"=>"23ref","t"=>"42tgrge","x"=>"2tgrdfgre2","y"=>"67jtghn34","z"=>"88uik");
                for ($i = 0; $i < strlen($str); $i++) {
                    if(isset($claves[$str[$i]]))
                        $aux .= $claves[$str[$i]];
                    else
                        $aux .= $str[$i];
                }
                return $aux;
            }
            $str = "Hola mario, que tal estas?";
            echo "<p>$str =>". cifrar($str)."</p>";
            
            
            
        ?>
    </body>
</html>
