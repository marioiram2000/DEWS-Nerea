<?php
    defne("PI",3.1415);
    
    function bisiesto($a){
        if($a%4==0 || ($a%4== 0 && $a%100!=0)){
            return true;
        }
        return false;
    }
    
    function dibujarTitulo($titulo){
        echo "<h2>".strtoupper($titulo)."<h2>";
    }


?>