<?php
if(!isset($_POST['submit'])){
    header("Location:ej4Login.php");
}

$nombre = $_POST['nombre'];
$pas = $_POST['pas'];

if($nombre=="" || $pas == ""){
    header("Location:ej4Login.php");
}

$f = fopen("../usuarios.txt", "r");
while(!feof($f)){
    $linea= trim(fgets($f));
    $partes = explode(";", $linea);
    print_r($partes);
    if($nombre==$partes[0]){
        if($pas==$partes[1]){
            fclose($f);
            header("Location:ej4Charla.php?nombre=$nombre");
        }else{
            fclose($f);
            header("Location:ej4Login.php?nombre=$nombre&pasIncorrecta");
        }
    }
}

fclose($f);
header("Location:ej4Alta.php?nombre=$nombre");
