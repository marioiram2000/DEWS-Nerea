<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    if(!isset($_SESSION['nombreCompleto'])){
        header("Location: nombre.php");
    }
    $nombreCompleto = $_SESSION['nombreCompleto'];
    if(isset($_POST['si'])){
        $no = "";
    }else{
        $no = "NO";
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form>
            <p>Su nombre y apellidos <?php echo $no." son: ".$nombreCompleto;?></p>
            <?php 
                if($no==""){
                    echo '<p>Gacias por usar este programa</p>';
                }else{
                    echo '<p>Vuelva al fromulario inicial utilizando el siguiente enclace</p>';
                }
            ?>
            <a href="nombre.php">Volver al formulario</a>
        </form>
    </body>
</html>
