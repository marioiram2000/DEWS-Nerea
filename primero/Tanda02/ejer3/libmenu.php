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
            //Evalua si el usuario y la contraseña son correctos
            function autentica($usu, $pas) {
                $socios = fopen('socios.txt', 'r');
                while(!feof($socios)){//mientras no se acabe el fichero
                    $linea = fgets($socios);//leo una linea
                    $linea_partida = explode(" ", $linea);
                    $usuario = $linea_partida[0];
                    $password = $linea_partida[1];
                    if($usu==$usuario && $pas == $password){
                        fclose($socios);
                        return 1;
                    }
                    fclose($socios);
                    return 0;
                }
            }
            //tras introducir un usuario obtiene su descuento
            function dameDcto($usu) {
                $socios = fopen('socios.txt', 'r');
                while(!feof($socios)){
                    $linea = fgets($socios);
                    $linea_partida = explode(" ", $linea);
                    $usuario = $linea_partida[0];
                    if($usu==$usuario){
                        $descuento = $linea_partida[2];
                        fclose($socios);
                        return $descuento;
                    }
                }
            }
            //tras introducir un TIPO devuelve un array de PLATOS CON PRECIO
            function damePlatos($tip) {
                $platos = fopen("platos.txt", "r");
                $platosTipo = array();
                while(!feof($platos)){
                    $linea = fgets($platos);
                    $linea = trim($linea);
                    $linea_partida = explode(" ", $linea);
                    $plato = $linea_partida[0];
                    $tipo = $linea_partida[1];
                    if($tip==$tipo){
                        $precio = $linea_partida[2];
                        $platosTipo[$plato] = $precio;
                    }
                }
                fclose($platos);
                return $platosTipo;
            }
            //tras introducir un PLATO, devuelve su PRECIO
            function damePrecio($nom){
                $platos = fopen("platos.txt", "r");
                while(!feof($platos)){
                    $linea = fgets($platos);
                    $linea_partida = explode(" ", $linea);
                    $plato = $linea_partida[0];
                    if($nom==$plato){
                        $precio = $linea_partida[2];
                        fclose($platos);
                        return $precio;
                    }
                }
            }
           
        ?>
    </body>
</html>
