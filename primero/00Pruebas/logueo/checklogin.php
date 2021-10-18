<?php
    $nombre=$_GET["nombre"];
    $pass=$_GET['pass'];

    if(isset($_GET["submit"])){
        if(strrev($nombre)==$pass){
            header("location: loginok.php");
        }else{
            header("location: login.html");

        }
    }




?>
