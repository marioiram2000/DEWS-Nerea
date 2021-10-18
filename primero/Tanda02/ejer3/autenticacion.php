<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    
    if(isset($_POST['submitSocio'])){
        
        include 'libmenu.php';
        $usu = $_POST['usuario'];
        $pas = $_POST['password'];
        if(autentica($usu, $pas)>0){
            session_start();
            $_SESSION['usuario'] = $usu;
            $_SESSION['password'] = $pas;
            $_SESSION['descuento'] = dameDcto($usu);
            header('Location: pedido.php');
        }else{
            header('Location: entrada.php?error');
        }
    }
    if(isset($_POST['submitInvitado'])){
        session_start();
        $_SESSION['usuario'] = $usu;
        $_SESSION['password'] = $pas;
        header('Location: pedido.php');
    }
    

?>
