<?php
$handle = fopen("../charla.txt", "r");
while(!feof($handle)){
    $linea = fgets($handle);
    echo $linea;
}

fclose($handle);