<?php
    if(!isset($_POST['submit'])){
        header("Location: login.php");
    }
    $pas = $_POST['password'];
    $usu = $_POST['usuario'];
    
    $fichero = fopen("usuarios.txt", 'r');
    if(!$fichero){
        echo "No se pudo abrir el archivo";
    }else{
        while(!feof($fichero)){
            $linea = fgets($fichero);
            $lineaSeparada = explode("  ", $linea);
            $usuario = $lineaSeparada[0];
            $password = $lineaSeparada[1];

            if($usuario==$usu){
                if($password==$pas){

                }else{

                }
            }else{
                header("Location: alta.php");
            }
        }
    
    fclose($fichero);
    }
    
    
?>