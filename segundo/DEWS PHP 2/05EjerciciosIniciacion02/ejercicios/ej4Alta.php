<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
        function comprobarNombre($nombre) {
            $f = fopen("../usuarios.txt", "r");
            while(!feof($f)){
                $linea= fgets($f);
                $partes = explode(";", $linea);
                if($nombre==$partes[0]){
                    fclose($f);
                    return false;
                }
            }    
            fclose($f);
            return true;
        }
        
        function registrarUsuario($nombre, $pas){
            $handle = fopen("../usuarios.txt", "a+");
            $str = "\n".$nombre.";".$pas;
            fwrite($handle, $str);
            fclose($handle);
        }
        ?>
    </head>
    <body>
        <?php
        $nombre = "";
        $error = "";
        $correcto = "";
        if(isset($_POST['nombre'])){
            $nombre = $_POST['nombre'];
        }
        if(isset($_GET['nombre'])){
            $nombre = $_GET['nombre'];
        }
        
        if(isset($_POST['submit'])){
            if($_POST['nombre']!="" && $_POST['pas']!=""){
                if(comprobarNombre($nombre)){
                    registrarUsuario($_POST['nombre'], $_POST['pas']);
                    $correcto = "Usuario registrado";
                }else{
                    $error="Lo sentimos, ese usuario ya está dado de alta";
                }
            }
            
        }
        
        
        ?>
        <form method="POST" action="ej4Alta.php">
            <table>
                <tr><th colspan="2">REGISTRO</th></tr>
                <tr>
                    <td><label for="nombre">Nombre de usuario:</label></td>
                    <td><input type="text" name="nombre" value="<?php echo $nombre?>"></td>
                </tr>
                <tr>
                    <td><label for="pas">Contraseña</label></td>
                    <td><input type="password" name="pas" value=""></td>
                </tr>
                <tr><td colspan="2"><input type="submit" name="submit" value="Guardar"></td></tr>
            </table>
        </form>
        <p><?php 
            if($correcto!=""){
                echo $correcto."<a href='ej4Login.php?nombre=$nombre'>Iniciar sesión</a>";
            }else if($error!=""){
                echo $error;
            }
        ?></p>
    </body>
</html>
