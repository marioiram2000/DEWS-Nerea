<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    $fondo="white";
    if(isset($_POST['submit_color']))
    {
        if(isset($_POST['color']))
            setcookie ("colorf", $_POST['color'], time()+(24*60*60));
    }

    if(isset($_COOKIE['colorf']))
        $fondo=$_COOKIE['colorf'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body style="background-color: <?php echo $fondo?>">

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Elija color
            <br/><input type="radio" name="color" value="red"/>Rojo
            <br/><input type="radio" name="color" value="blue"/>Azul
            <br/><input type="radio" name="color" value="green"/>Verde
            <br/><input type="radio" name="color" value="yellow"/>Amarillo
            <br/><input type="submit" name="submit_color" value="CAMBIAR"/>
        </form>
    </body>
</html>
