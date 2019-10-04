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
            function euroDolar($n){
                return $n / 0.9129;
            }
            function dolarEuro($n){
                return $n / 1.095;
            }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            Cantidad: <input type="text" name="n">
            <p><input type="radio" name="divisa" value="e" >Euros a dólares</p>
            <p><input type="radio" name="divisa" value="d">Dólares a euros</p>
            <p><input type="submit" name="submit" value="CONVERTIR"></p>
        </form>
        <?php 
            if(isset($_POST['submit'])){
                               
                if(empty($_POST['n'])){
                    echo "vacio";
                }else{
                    $n = $_POST['n'];
                    if(is_numeric($n)){
                        $v = $_POST['divisa'];
                        echo "-------".$v."-----------";
                        if($v=="e"){
                            echo euroDolar($n)."$";
                        }else{
                            echo dolarEuro($n)."€";
                        }
                    }else{
                        echo "No numerico";
                    }
                }
            }
        ?>
    </body>
</html>
