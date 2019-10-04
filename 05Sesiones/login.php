<!DOCTYPE html>
<?php
        //login correcto si el password es el nombre al reves
        session_start();
        if(isset($_POST['submitlogin'])){
            $nombre = $_POST['nombre'];
            $password = $_POST['pass'];   
            if(strrev($nombre)==$password){
                $_SESSION['login']=$nombre;
                header("location: polls.php");
            }else{
                echo '<p>loggin erroneo</p>';
            }
        }
        
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            Nombre: <input type="text" name="nombre">
            </br>
            Password: <input type="password" name="pass">
            </br>
            <input type="submit" value="LOGIN" name="submitlogin">
        </form>
    </body>
</html>
