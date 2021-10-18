<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        if(!isset($_SESSION['nombres'])){
            $_SESSION['nombres']=array();
        }
        if(isset($_POST['aniadir'])){          
            $letras=true;
            for ($index = 0; $index < strlen($_POST['nombre']); $index++) {
                if((ord(strtolower($_POST['nombre'][$index]))< ord("a") || ord(strtolower($_POST['nombre'][$index]))> ord("z"))
                    && $_POST['nombre'][$index] != " "){
                    $letras = false;
                }
            }
            if($letras)
                $_SESSION['nombres'][$_POST['nombre']]=$_POST['nombre'];
        }
        
        if(isset($_POST['borrar'])){    
            unset($_SESSION['nombres'][$_POST['nombre']]);
        }
        
        if(isset($_GET['cerrarSesion'])){
            session_destroy();
            header("location:".$_SERVER['PHP_SELF']);
        }
        
        ?>        
        <table>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
                <tr><td>Escriba algún nombre</td><td><input type="text" name="nombre"></td></tr>
                <tr>
                    <td><input type="submit" name="aniadir" value="AÑADIR"></td>
                    <td><input type="submit" name="borrar" value="BORRAR"></td>
                </tr>
            </form>
        </table>
        <br>
        <?php
        if(count($_SESSION['nombres'])==0){
            echo "<p>Todavía no se ha introducido ningún nombre</p>";
        }else{
            echo "<p>Nombres introducidos:</p>";
            echo "<ul>";
            foreach ($_SESSION['nombres'] as $nombre) {
                echo "<li>$nombre</li>";
            }
            echo "</ul>";
        }
        ?>
        <a href="<?php echo $_SERVER['PHP_SELF']?>?cerrarSesion">Cerrar sesión (Se perderán todos los datos)</a>
    </body>
</html>

