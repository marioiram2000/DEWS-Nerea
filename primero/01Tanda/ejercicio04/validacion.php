<?php
    if(!isset($_POST['submit'])){
        header("Location: login.php");
    }else{
        $pas = $_POST['password'];
        $usu = $_POST['usuario'];

        $f=fopen("usuarios.txt", 'r');
        while(!feof($f)){
            $linea = fgets($f);
            $lineaSeparada = explode(";", $linea);
            $usuario = $lineaSeparada[0];
            $password = $lineaSeparada[1];
            if($usuario==$usu){
                if($password==$pas){

                }else{
                    header("Location: login.php?usuario=$usuario");
                }
            }else{
                header("Location: alta.php");
            }


        fclose($f);
        }
    }
    
    
    
?>