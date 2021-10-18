<?php
function autentica($usu, $pas) {
    $handle = fopen("socios.txt", "r+");
    while(!feof($handle)){
        $linea = fgets($handle);
        $partes = explode("\t", $linea);
        if($partes[0]==$usu && $partes[1] == $pas){
            fclose($handle);
            return 1;
        }
    }
    fclose($handle);
    return 0;
}

function dameDcto($usu) {
    $handle = fopen("socios.txt", "r+");
    while(!feof($handle)){
        $linea = fgets($handle);
        $partes = explode("\t", $linea);
        if($partes[0]==$usu){
            fclose($handle);
            return $partes[2];
        }
    }
    fclose($handle);
    return 0;
}

function damePlatos($tipo) {
    $handle = fopen("platos.txt", "r+");
    $platos = [];
    while(!feof($handle)){
        $linea = fgets($handle);
        $partes = explode("\t", $linea);
        if($partes[1]==$tipo){
            $platos[$partes[0]] = $partes[2];
        }
    }
    fclose($handle);
    return $platos;
}

function damePrecio($plato) {
    $handle = fopen("platos.txt", "r+");
    while(!feof($handle)){
        $linea = fgets($handle);
        $partes = explode("\t", $linea);
        if($partes[0]==$plato){
            fclose($handle);
            return $partes[2];
        }
    }
    fclose($handle);
    return -1;
}