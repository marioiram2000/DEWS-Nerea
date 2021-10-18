<?php
function inicializarArray() {
    $arr = array();
    for ($i = 0; $i < 8; $i++) {
        $arr[$i] = "";
    }
    return $arr;
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
        $tipos = inicializarArray();
        $selects = inicializarArray();
        $checks = array();
        $cont = 0;
        
        if(isset($_POST['submit'])){
            
            for ($i = 0; $i < 8; $i++) {
                
                if($_POST["tipos"][$i]!="" && !in_array($_POST["tipos"][$i], $tipos)){
                    $cont ++;
                }
                $tipos[$i] = $_POST["tipos"][$i];
                
                $selects[$i] = $_POST["selects"][$i];
                
            }
            if(isset($_POST['fallos'])){
                for ($i = 0; $i < count($_POST['fallos']); $i++) {
                    $checks[] = $_POST['fallos'][$i];
                }
            }
        }
        
        if($cont>=1){
            session_start();
            $t = array();
            $s = array();
            $c = array();
            for ($i = 0; $i < 8; $i++) {
                if($tipos[$i]!=""){
                    $t[] = strtoupper($tipos[$i]);
                    $s[] = $selects[$i];
                    if(in_array($i, $checks)){
                        $c[] = "true";
                    }else{
                        $c[] = "false";
                    }                    
                }
            }
            $_SESSION['tipos'] = $t;
            $_SESSION['cantidades'] = $s;
            $_SESSION['grabarFallos'] = $c;
            header("location:preguntas.php");
            exit();
        }else{
            if(isset($_POST['tipos'])){
                echo "<h4>DEBES HABER AL MENOS 3 TIPOS DISTINTOS</h4>";
            }            
        }
        ?>
        <h3>CONFIGURA UN MÍNIMO DE 3 TIPOS DE PREGUNTAS</h3>
        <table>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
            <tr><th>TIPO DE PREGUNTA</th><th>CANTIDAD</th><th>GRABAR FALLOS</th></tr>
            <?php
            for ($i = 0; $i < 8; $i++) {
                echo "<tr>";
                    echo "<td>".($i+1);
                        echo "<input type='text' name='tipos[]' value='".$tipos[$i]."'>";
                    echo "</td>";
                    echo "<td>";
                        echo "<select name='selects[]'>";
                            for ($j = 1; $j <= 3; $j++) {
                                if($selects[$i] == $j){
                                    echo "<option value='$j' selected>$j</option>";
                                }else{
                                    echo "<option value='$j'>$j</option>";
                                }
                                
                            }
                        echo "</select>";
                    echo "</td>";
                    echo "<td>";
                        if(in_array($i, $checks)){
                            echo "<input type='checkbox' name='fallos[]' value='$i' checked>Grabar fallos";
                        }else{
                            echo "<input type='checkbox' name='fallos[]' value='$i'>Grabar fallos";
                        }
                        
                    echo "</td>";
                    
                echo "</tr>";
            }
            ?>
            <tr><td colspan="3"><input type="submit" name="submit" value="ENVIAR TIPOS"></td></tr>
            </form>
        </table>
    </body>
</html>
