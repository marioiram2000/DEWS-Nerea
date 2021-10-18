<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php   
$error = "";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php 
        if(isset($_POST['submit'])){
            $pas = $_POST['password'];
            $usu = $_POST['usuario'];
            $existeUsu = false;
            
            $f = fopen("usuarios.txt", 'a+');
            while(!feof($f)){
                $linea = fgets($f);
                if($linea!=""){
                    $lineaSeparada = explode(";", $linea);
                    $usuario = $lineaSeparada[0];
                    $password = $lineaSeparada[1];

                    if($usuario==$usu){
                        $existeUsu = true;
                    }
                }

            }
            if($existeUsu){
                $error = "<p style='color = red'>Lo sentimos, ya existe un usuario $usu</p>";
            }else{
                $cadena = $usu+";"+$pas;
                fputs($f, $cadena);
                fclose($f);
                echo "<p>$usu : has sido dado de alta</p>";
                echo "<a href='charla.php'>ENTRAR AL CHAT</a>";    
            }
        }else{
        echo $error?>
        <h2>REGISTRATE</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <h2>Login: <input type="text" name='usuario'></h2>
            <h2>Password: <input type="password" name='password'></h2>
            <input type="submit" value="REGISTRAR" name="submit">
        </form>
        <?php }?>
    </body>
</html>
