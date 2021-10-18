<?php
session_start();
include 'array.php';


function sacarPregunta($tipo, $preguntas, $todaspregs) {
    $pregunta = array_rand($preguntas[$tipo]);
    while(in_array($pregunta, $todaspregs)){
        $pregunta = array_rand($preguntas[$tipo]);
    }
    return $pregunta;
}

function sacarRespuestas($pregunta, $preguntas, $tipo) {
    return $preguntas[$tipo][$pregunta];
}

function grabarFallos($fallos){
    $f = fopen("fallos.txt", "w");
    fputs($f, "Estas son las preguntas en las que has fallado, revisate la teoría \n\r");
    foreach ($fallos as $fallo) {
        fputs($f, $fallo."\n\r");
        //echo $fallo;
    }
    
    fclose($f);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $tipos = $_SESSION['tipos'];
        $cantidades = $_SESSION['cantidades'];
        $grabarFallos = $_SESSION['grabarFallos'];
        $ipregs = array();
        $mispregs = array();
        $todaspregs = array();
        $aciertos = array();
        $respondido = false;
        $fallos = array();
        
        for ($i = 0; $i < count($tipos); $i++) {
            $ipregs[] = 1;
            $aciertos[] = 0;
        }
        
        if(isset($_SESSION['mispregs'])){
            $mispregs = $_SESSION['mispregs'];
        }
        
        if(isset($_SESSION['todaspregs'])){
            $todaspregs = $_SESSION['todaspregs'];
        }
        
        if(isset($_SESSION['ipregs'])){
            $ipregs = $_SESSION['ipregs'];
        }
        
        if(isset($_SESSION['aciertos'])){
            $aciertos = $_SESSION['aciertos'];
        }
        
        if(isset($_SESSION['fallos'])){
            $fallos = $_SESSION['fallos'];
        }
        
        if(isset($_POST['submit'])){
            $respondido = true;
            $cantidades[$_POST['indice']] --;
            $_SESSION['cantidades'] = $cantidades;
            
            $ipregs[$_POST['indice']] ++;
            $_SESSION['ipregs'] = $ipregs;
            
            if(isset($_POST['resp'])){
                $t = $_POST['tipo'];
                $p = $_POST['preg'];
                $r = sacarRespuestas($p, $preguntas, $t);
                if($_POST['resp']==$r[(count($r)-1)]){
                    $aciertos[$_POST['indice']] ++;
                    $_SESSION['aciertos'] = $aciertos;
                }else{
                    if($grabarFallos[$_POST['indice']]==true){
                        $fallos[] = $p;
                        $_SESSION['fallos'] = $fallos."\t".$preguntas[$t][$r[(count($r)-1)]];
                    }
                }
            }
        }
        ?>
        <table>
            <tr><th>TIPO</th><th>Nº Pregunta</th><th>Pregunta</th><th>Respuestas</th><th></th><th></th></tr>
            
            <?php
            for ($i = 0; $i < count($tipos); $i++) {
                echo "<tr>";
                    echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
                    echo "<td>".$tipos[$i]."</td>";
                    echo "<td>".$ipregs[$i]."</td>";
                    if(!$respondido){
                        $pregunta = sacarPregunta($tipos[$i], $preguntas, $todaspregs);
                        $mispregs[$tipos[$i]] = $pregunta;
                        $todaspregs[] = $pregunta;
                        $_SESSION['mispregs'] = $mispregs;
                        $_SESSION['todaspregs'] = $todaspregs;
                    }else{
                        if($cantidades[$i]>0){
                            if($_POST['indice']==$i){
                                $pregunta = sacarPregunta($tipos[$i], $preguntas, $todaspregs);
                                $mispregs[$tipos[$i]] = $pregunta;
                                $todaspregs[] = $pregunta;
                                $_SESSION['mispregs'] = $mispregs;
                                $_SESSION['todaspregs'] = $todaspregs;
                            }else{
                                $pregunta = $mispregs[$tipos[$i]];
                            }                         
                        }else{
                            $pregunta = "";
                        }
                    }
                    if($pregunta!=""){
                        echo "<td>".$pregunta."</td>";
                        $respuestas = sacarRespuestas($pregunta, $preguntas, $tipos[$i]);
                        //print_r($respuestas);
                        echo "<td>";
                        for ($j = 0; $j < count($respuestas)-1; $j++) {                        
                            echo "<span><input type='radio' name='resp' value='$j'>$respuestas[$j]</span>";
                        }
                        echo "</td>";
                        echo "<td><input type='submit' value='ENVIAR RESPUESTA' name='submit'></td>";
                    }else{
                        echo "<td></td><td></td>";
                    }
                    echo "<td>$aciertos[$i] aciertos</td>";
                    echo "<input type='hidden' name='tipo' value='$tipos[$i]'>";
                    echo "<input type='hidden' name='preg' value='$pregunta'>";
                    echo "<input type='hidden' name='indice' value='$i'>";
                    echo '</form>';
                echo "</tr>";
            }

            $finalizado = true;
            for ($i = 0; $i < count($cantidades); $i++) {
                if($cantidades[$i]>0){
                    $finalizado = false;
                }
            }
            
            if($finalizado){
                if(count($fallos)>0){
                    grabarFallos($fallos);
                    echo "<br><p><a href='fallos.txt'>Ver fallos</a></p>";
                }
            }
            ?>
        </table>
        
    </body>
</html>
