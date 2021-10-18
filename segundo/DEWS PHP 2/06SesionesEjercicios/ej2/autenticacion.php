<?php
include 'libmenu.php';

if(isset($_POST['submitInvitado'])){
    session_start();
    $_SESSION['desc'] = 0;
    header("Location:pedido.php");
    exit();
}else 
    if(isset($_POST['submitSocio'])){
        if(autentica($_POST['usu'], $_POST['pas'])>0){
            session_start();
            $_SESSION['usu'] = $_POST['usu'];
            $_SESSION['desc'] = dameDcto($_POST['usu']);
            header("Location:pedido.php");
        }
        else{
            header("Location:entrada.php?errorAutentica");
            exit();
        }
    
    }
    else{
       header("location:entrada.php");
        exit();
    }
 header("location:entrada.php");
 exit();