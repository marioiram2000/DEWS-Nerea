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
        /*
            echo "<h1>EJERCICIO 1 </h1>"
        ?>
        <?php
            $fecha = date("l, j");
            $fecha .= "th";
            $fecha .= date(" F");
            echo $fecha;
        ?>
        <?php
            $tactual = time();
            $tnavidad = strtotime("2019/12/25");
            echo"<br>";
            echo "Navidad es en ".((int)($tnavidad-$tactual)/(60*60*24))." dias";
        ?>
        <?php
            $dias = array("lunes ","martes ","miercoles ","jueves ","viernes ","Sabado ","domingo ");
            $semana = "";
            foreach ($dias as $dia){
                $semana .= $dia . " ";
            }
            echo"<br>";
            echo $semana;
        ?>
        <?php
            echo"<br>";
            
            $str = "niño moñoño ñoqui";
            $aux = "";
            
            for ($i=0; $i<strlen($str); $i++){
                
                if($str[$i]=="ñ"){
                   $aux .= "gn";
                }else{
                    $aux .= $str[$i];
                }
            }
            
            $aux = str_replace("ñ", "gn", $str);
            echo $aux;
        ?>
        <?php
        echo"<br>";
        $arr1 = [];
        for ($index = 0; $index < 20; $index++) {
           $arr1[] = rand(0, 100);
           echo $arr1[$index]. " ";
        }
        ?>

        <?php
            echo"<br>";
            $arr2 = [];
            $index = 0; 
            while ($index < 30){
                $n = rand(0, 50);
                while(in_array($n, $arr2)){
                    $n = rand(0, 50);
                }
                $arr2[]=$n;
                echo $arr2[$index]. " ";
                $index ++;
            }
        ?>
        
        <?php
            echo "<h1>EJERCICIO 2 </h1>"
        ?>
        
        <?php
            echo"<br>";
            for ($index = 0; $index < 30; $index++) {
                $arrT[] = rand(15, 30);
                echo $arrT[$index]. " ";
            }
            $med = array_sum($arrT)/30;
            echo"<br>";
            echo "media: ". $med;
            echo" redondeada ->";
            echo round($med);
            sort($arrT);
            echo"<br> Temperaturas mínimas ->";
            for ($index = 0; $index < 5; $index++){
                echo $arrT[$index]. " ";
            }
            rsort($arrT);
            echo"<br> Temperaturas máximas ->";
            for ($index = 0; $index < 5; $index++){
                echo $arrT[$index]. " ";
            }
        
         
        ?>
         
        <?php
        
            $arrCiu = ["Vitoria", "Bilbo", "Donosti", "Vitoria", "Madrid", "Merida", "Bilbo", "Barcelona", "Pamplona", "Vitoria"];
            echo"<ol>";
            for ($i = 0; $i < count($arrCiu); $i++) {
                echo "<li> {$arrCiu[$i]} </li>";
            }
            echo"</ol>";
            $arrCiu = array_unique($arrCiu);
            echo"<ol>";
            foreach ($arrCiu as $value) {
                echo "<li> {$value} </li>";
            }
            echo"</ol>";
        
        ?>
        
        <?php
       
             $imags =array("camion.jpg", "casa.jpg", "coche.jpg", "familia.jpg", "flor.jpg", "globo.jpg", "llama.jpg", "montaña.jpg", "moto.jpg", "playa.jpg", "camion.jpg", "casa.jpg", "coche.jpg");
             $imags2 = array_unique($imags);
             //print_r($imags);
             //echo "<br>".count($imags2);
             //exit();
        ?>
        <table>
            <?php
                $i=0;
                while($i<count($imags2)){
                    echo "<tr>";
                    for ($index = 0; $index < 3 && $i<count($imags2); $index++) {                        
                        $ruta="imagenes/".$imags2[$i];
                        echo"<td>";                                
                            echo "<img src='$ruta' height='100'>";    
                            $i++;
                        echo"</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </table>
        ?>
        
        <?php
            function f($peli){
                $cont = 0;
                $personas = array (
                    "adrian" => array ("matrix 1", "matrix 2", "matrix 3"),
                    "pepe" => array ("shrek 1", "shrek 2", "shrek 3"),
                    "felipe" => array ("spideman 1", "spideman 2", "spideman 3"),
                    "antonio" => array ("matrix 1", "shrek 2", "spideman 3"),
                    "jose" => array ("matrix 1", "shrek 3", "spideman 3")
                );
                foreach ($personas as $key => $value) {
                    foreach ($value as $pelicula){
                        if ($peli == $pelicula){
                        $cont ++;
                        }
                    }
                }
                return $cont;
            }
            echo"<br>";
            echo "Matrix 1: ".f("matrix 1"). "  personas";
            echo"<br>";
            echo "Shrek 2: ".f("shrek 2"). "    personas";
            echo"<br>";
            echo "spideman 3: ".f("spideman 3"). "  y6personas";
        ?>
        
        <?php
            $array = ["lunes","martes","miercoles","jueves","viernes","sabado","domingo"];
            function f($arr, $ini, $fin){
                echo '<table border=1>';
                    echo '<tr>';
                        echo '<td>  </td>';
                        foreach ($arr as $value) {
                            echo '<td>'.$value.'</td>';
                        }
                    echo '</tr>';
                    $filas = $fin-$ini;
                    $aux = $ini;
                    for ($index = 0; $index < $filas; $index++) {
                        if($index%2!=0){
                            echo '<tr>';
                        }else{
                            echo '<tr bgcolor = "#dddddd">';
                        }
                        $hora = $aux.":00";
                        echo '<td>'.$hora.'</td>';
                        for ($index1 = 0; $index1 < count($arr); $index1++) {
                            echo '<td>  </td>';
                        }
                        $aux ++;
                        echo '</tr>';
                    }
                echo '</table>';
            }
            f($array, 8, 15);
        ?>
        
        <?php 
            $handle = fopen("fich.txt", "r");
            $linea = fgets($handle);
            while(!feof($handle)){
                $arr = explode(" ", $linea);
                echo "<p>";
                echo "Web: ".$arr[1]." URL: ".$arr[0];
                echo "</p>";
                $linea = fgets($handle);
            }
            fclose($handle);
        
        */?>
    </body>
</html>
