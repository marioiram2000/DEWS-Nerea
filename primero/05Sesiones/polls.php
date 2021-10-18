<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    session_start();
    if(!isset($_SESSION['login'])){
        header("location: login.php");
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
            if(!isset($_SESSION['favoritas'])){
                $_SESSION['favoritas']=array();
            }
            if (isset($_GET['peli'])){
                if(!in_array($_GET['peli'], $_SESSION['favoritas']))
                $_SESSION['favoritas'][]=$_GET['peli'];
            }
            
            echo "<p>Bienvenido ".$_SESSION['login']." a nuestra página de valoraciones...</p>";
            
            $pelis=array("El padrino","El golpe","El resplandor","Cenicienta","Pulp fiction");
            echo "<ul>";
            foreach ($pelis as $peli) {
                echo "<li>$peli:&nbsp ";
                $enlace = $_SERVER['PHP_SELF']."?peli=$peli";
                if(!in_array($peli, $_SESSION['favoritas'])){
                    echo "<a href='$enlace'>Me gusta</a></li>";
                }else{
                    echo "Favorita".'</li>';
                }
            }
            echo '</ul>';
            
            if(count($_SESSION['favoritas'])>0){
                echo"<p><a href='final.php'>Grabar favoritos</a></p>";
            }
        ?>
    </body>
</html>
