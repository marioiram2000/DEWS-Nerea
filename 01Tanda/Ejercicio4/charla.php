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
            function palabras_ofensivas($texto)
            {
                $f= fopen("ofensivas.txt", 'r');
                while(!feof($f))
                {
                    $linea= trim(fgets($f));
                    $texto=str_replace($linea,"***",$texto);
                }
                fclose($f);
                return $texto;
            }
            function escribir_fichero()
            {
                $f=fopen("charla.txt",'a');
                $texto=$_POST['texto'];
                $texto= str_replace(":)", "<img src='img/smile.png' height=10 width=10/>", $texto);
                $texto= str_replace(":(", "<img src='img/sad.png' height=10 width=10/>", $texto);
                $texto=palabras_ofensivas($texto);
                $cadena="\n<b>".$_GET['nombre']."</b>: ".$texto;
                fputs($f, $cadena);
                fclose($f);
            }
            if(!isset($_GET['nombre']))
            {
               header('Location: login.php');
               die();
            }
            if(isset($_POST['enviar_mensaje']))
            {
                escribir_fichero();
            }
        ?>
        
        <table>
            <iframe src="contenido_charla.php"></iframe>
            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                <tr>
                    <td>Usuario:</td>
                    <td><input type="text" name="user" value="<?=$_GET['nombre']?>" readonly/>
                </tr>
                <tr>
                    <td>Mensaje:</td>
                    <td><input type="text" name="texto" value=""/></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="enviar_mensaje" value="Enviar"/></td>
                </tr>
            </form>
        </table>
    </body>
</html>
