<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once 'fich.inc.php';
        
        
        if (isset($_POST['submit_alta'])){
            if ( (empty($_POST['usuario'])) ||
                 (strlen($_POST['password1'])<2) ||
                  $_POST['password1']!=$_POST['password2']  
                    )
                echo "<p>Error</p>";
            else{
                alta($_POST['usuario'],$_POST['password1'],"usuarios.txt");
                echo "<p>Registrado ". $_POST['usuario'] . "</p>";
            }
        }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <br> Usuario: <input type="text" name="usuario" />
            <br>Password: <input type="password" name="password1" />
            <br>Repite password: <input type="password" name="password2" />
            <br><input type="submit" name="submit_alta" value="REGISTRAR" />            
        </form>
    </body>
</html>
