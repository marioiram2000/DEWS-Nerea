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
        <h2>REGISTRATE</h2>
        <?php
            $usuario="";
            $pass="";
            $error="";
            $alta=false;
            function comprobar_nombre()
            {
                $f=fopen("usuarios.txt", 'r');
                while (!feof($f))
                {
                    $linea= trim(fgets($f));
                    $lineasep=explode(";",$linea);
                    if($lineasep[0]==$_POST['username'])
                    {
                       $error="<p>Lo sentimos, ya existe un usuario <b>".$_POST['username']."</b></p>";
                       return $error;
                    }
                }
            }
            
            function dar_de_alta()
            {
                $f=fopen("usuarios.txt",'a');
                
                $cadena="\n".$_POST['username'].";".$_POST['pass'];
                fputs($f, $cadena);
                fclose($f);
            }
            
            if(isset($_GET['nombre']))
            {
                $usuario=$_GET['nombre'];
                $pass=$_GET['pass'];
            }
            
            if(isset($_POST['submit_reg']))
            {
                $error=comprobar_nombre();
                if($error=="")
                {
                    dar_de_alta();
                    $alta=true;
                }
            }
        ?>
        
        <?php
        if($alta==false)
        {
            echo $error?>
            <form method="POST" action="alta.php">
                <table>
                    <tr>
                        <td>Login:</td>
                        <td><input type="text" name="username" value="<?php echo $usuario; ?>"/></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="pass" value="<?php echo $pass; ?>"/></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit_reg" value="REGISTRAR"/></td>
                    </tr>
                </table>
            </form>
        <?php
        }
        else
        {
            echo "<p>".$_POST['username'].": Has sido dado de alta</p>";
            echo "<a href='charla.php?nombre=".$_POST['username']."'>ENTRAR AL CHAT</a>";
        }
        ?>
    </body>
</html>
