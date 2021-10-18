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
        //cadenas
        
        //frase con colores
        $cad="Buenos dias";
        for ($i = 0; $i < strlen($cad); $i++) {
            if($i%2==0){
                $micolor="#111111";
            }else{
                $micolor="#888888";
            }
            echo "<span style='color:$micolor'>".$cad[$i];
        }
        
        echo "<p>". str_replace("o", "X", $cad). "</p>";
        
        
        //arrays
        $meses = array("enero","febrero","marzo");
        $meses[]="abril";
        $meses[]="mayo";
        /*
        echo "<p>Meses</p>";
        foreach ($meses as $mes) {
            echo $mes."\t";
        }
         echo "<p></p>";
        if (in_array("enero", $meses)){
            echo "enero encontrado";
        }
         echo "<p></p>";
         if (!in_array("Enero", $meses)){
            echo "Enero no encontrado";
        }       
        */
        //array asociativo
        
        $paises = array("PT" => "potugal" , "DE" => "alemania" , "FR" => "francia");
        $paises["ES"] ="ESPAÑA";
        $paises["DE"] ="deuschland";
        
        echo "<table>";
        foreach ($paises as $cod_pais => $nombre_pais) {
            echo '<tr>';
                echo '<td>'.$cod_pais.'</td>';
                echo '<td>'.$nombre_pais.'</td>';   
            echo '</tr>';
        }
        echo "</table>";
        
        if(array_key_exists("PH", $paises)){
            echo "nombre de pais con codigo ph". $paises["PH"];
        }else{
            echo "nombre de pais con codigo ph inexistente";
        }
        
        //array de arrays
        
        $ventas=array(
            "JUAN"=>array(100,200),
            "ANA"=>array(300,200,100),
            "PEDRO"=>array(100000,200),
            "MARTIN"=>array(100,2000)
        );
        
        //el vendedor con la mayor venta
        $max_venta=0;
        
        foreach ($ventas as $vendedor => $arrventas) {
            foreach ($arrventas as $venta) {
                if($max_venta<$venta){
                    $max_venta = $venta;
                    $max_vendedor = $vendedor;
                }
            }
        }if(isset($max_vendedor)){
            echo 'el vendedor con la mayor venta es '.$max_vendedor;
        }
        
        //
        
        
        
        ?>
    </body>
</html>
