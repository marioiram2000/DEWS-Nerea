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
        
            if (isset($_POST['submit_login'])){
                
                if (login($_POST['usuario'],$_POST['pass'],"usuarios.txt")){
                     incrementa_logueos($_POST['usuario'],"logueos.txt");
                     echo "<p>".logueos($_POST['usuario'],"logueos.txt")."</p>";
                }
                        
                   
                else{
                    incrementa_logueos($_POST['usuario'],"logueos.txt");
                    echo "Creado usuario nuevo";
                }
                   
                
            }
       
                
        
        ?>
        
         <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <br> Usuario: <input type="text" name="usuario" />
            <br>Password: <input type="password" name="pass" />           
            <br><input type="submit" name="submit_login" value="LOGIN" />            
        </form>
    </body>
</html>
