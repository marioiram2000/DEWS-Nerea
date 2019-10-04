<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
    }
    if(isset($_GET['vaciar'])){
        unset($_SESSION['favoritas']);
        header("location: polls.php");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            echo "Tus pelis favoritas son:";
            foreach ($_SESSION['favoritas'] as $peli) {
                echo '<p>'.$peli.'</p>';
            }
            echo "<p><a href='".$_SERVER['PHP_SELF']."?vaciar'>VACIAR</a></p>";
        ?>
    </body>
</html>
