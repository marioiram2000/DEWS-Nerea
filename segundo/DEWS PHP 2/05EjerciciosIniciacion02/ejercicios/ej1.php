<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
        
        ?>
    </head>
    <body>        
        <?php
        $arrDesp=[3,5,10];
        $carpetaArchivos = "ficherosCifrado";
        $texto = '';
        $errorT = "";
        $errorC = "";
        $desp = "";
        $arrArchivos = sacarArchivos($carpetaArchivos);
        $resul = "";
        
        function cifrarCesar($d, $texto) {
            $aux = "";
            for ($i = 0; $i < strlen($texto);$i++) {
                $codigo = ord($texto[$i])+$d;
                if($codigo>ord("Z")){
                    $codigo-=26;
                }
                $aux .= chr($codigo);
            }
            return $aux;
        }
        
        function cifrarSust($ruta, $texto) {
            $aux = "";
            $f = fopen($ruta, "r");
            $linea = fgets($f);
            for ($i = 0; $i < strlen($texto); $i++) {
                $caracter = $texto[$i];
                $indice = ord($caracter)-ord("A");
                $aux .= $linea[$indice];
            }
            fclose($f);
            return $aux;
        }
        
        function sacarArchivos($carpetaArchivos){
            $arr = [];
            $d = opendir($carpetaArchivos);
            while(($entrada= readdir())!=false){
                if($entrada!="." && $entrada != "..")
                    $arr[] = $entrada;
            }
            closedir();
            return $arr;
        }
        
        if(isset($_POST['cesar'])){
            if($_POST['texto'] != "") $texto = strtoupper($_POST['texto']);
            else $errorT = "introduce algún texto para cifrar";
            
            if(!isset($_POST['desp'])) $errorC = "Selecciona una de las opciones";
            else $desp = $_POST['desp'];            
            
            if($errorC == $errorT){
                $resul = "TEXTO CIFRADO: ".cifrarCesar($desp, $texto);
            }
            
        }else if(isset($_POST['sustitucion'])){
            if($_POST['texto'] != ""){
                $texto = strtoupper($_POST['texto']);
                $ruta = "ficherosCifrado/".$_POST['ficheroClave'];
                $resul = "TEXTO CIFRADO: ".cifrarSust($ruta, $texto);
            }else{
                $errorT = "introduce algún texto para cifrar";
            }
        }
        
        
        ?>
        
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <table>
                <tr>
                    <td>TEXTO A CIFRAR</td>
                    <td><input type="text" name="texto" value="<?php echo $texto?>"/></td>
                    <td style="color:red;"><?php echo $errorT;?></td>
                </tr>
                <tr>
                    <td>Desplazamiento</td>
                    <td>
                    <?php 
                        foreach ($arrDesp as $value) {
                            if($value == $desp){
                                echo "<input type='radio' name='desp' value='$value' checked>$value<br>";
                            }else{
                                echo "<input type='radio' name='desp' value='$value'>$value<br>";
                            }
                            
                        }
                    ?>
                    </td>
                    <td><input type="submit" name="cesar" value="CIFRADO CESAR" ></td>
                    <td style="color:red;"><?php echo $errorC?></td>
                </tr>
                <tr>
                    <td>Fichero de clave</td>
                    <td>
                        <select name="ficheroClave">
                            <?php
                            foreach ($arrArchivos as $archivo) {
                                echo "<option value='$archivo'>$archivo</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td><input type="submit" name="sustitucion" value="CIFRADO POR SUSTITUCION"></td>
                </tr>
                <tr><td><strong><?php echo $resul?></strong></td></tr>
            </table>
        </form>
    </body>
</html>