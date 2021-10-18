<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="5">
        <title></title>
        <?php
        function escribirLinea($str) {
            $handle = fopen("../charla.txt", "a+");
            $str = corregirTexto($str);            
            fputs($handle, $str);            
            fclose($handle);
        }
        
        function corregirTexto($str){
            $handle = fopen("../palabrasOfensivas.txt", "r");
            
            $str = str_replace(":)", "<img src='cara_feliz.jpg' width='25'>'", $str);
            $str = str_replace(":(", "<img src='cara_triste.jpg' width='25'>'", $str);
            
            while(!feof($handle)){
                $palabra = trim(fgets($handle));
                $asteriscos = "";
                for ($i = 0; $i < strlen($palabra); $i++) {
                    $asteriscos .='*';
                }
                $str = str_replace($palabra, $asteriscos, $str);
            }
            
            fclose($handle);
            return $str;
        }
        ?>
    </head>
    <body>
        <?php
        $nombre = "";
        if(isset($_POST['submit'])){
            $nombre = $_POST['nombre'];
            $str = "<strong>".$_POST['nombre'].": </strong>".$_POST['texto']."<br>";
            escribirLinea($str);
        }else{
            $nombre = $_GET['nombre'];
        }
        ?>
        <iframe src="ej4Contenido_charla.php"></iframe>
        <table>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <tr>
                    <td>Usuario:</td><td colspan="3"><strong><?php echo $nombre?></strong></td>
                </tr>
                <tr>
                    <td>Mensaje:</td><td colspan="2" rowspan="2"><input type="text" name="texto"></td>
                </tr>
                <tr><td><input type="submit" name="submit" value="Enviar"></td></tr>
                <input type="hidden" name="nombre" value="<?php echo $nombre?>">
            </form>
        </table>
    </body>
</html>
