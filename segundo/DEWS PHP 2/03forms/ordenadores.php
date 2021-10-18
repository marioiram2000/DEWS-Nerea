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
        include 'ordenadores.inc.php';
        $indice = 0;
        $comps = array_keys($componentes);
        $error = "";
        $seleccionados = "";
        
        
        if(isset($_POST["submit"])){
            if(isset($_POST['modelo'])){
                $seleccionados .= $_POST['seleccionados']."_".$comps[$indice].":".$_POST['modelo'];
                $indice = $_POST['indice']+1;
                
                
                if($indice == count($comps)){
                    header("location:ordenadores.fin.php?seleccionados=$seleccionados");
                }
                
            }else{
                $seleccionados .= $_POST['seleccionados'];
                $indice = $_POST['indice'];
                $error = "selecciona alguno";
            }
            
        }
        $modelos = $componentes[$comps[$indice]];
        
        
        echo "<h1>".$comps[$indice]."</h1>";
        
        echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
        
        for ($i = 0; $i < count($modelos); $i++) {
            echo "<p><input type='radio' name='modelo' value='".$modelos[$i]."' id='".$modelos[$i]."'>"
                    . "<label for='$modelos[$i]'>$modelos[$i]</label></p>";
        }
        echo "<input type='hidden' name='indice' value='$indice'/>";
        echo "<input type='hidden' name='seleccionados' value='$seleccionados'/>";
        
        if($indice == count($comps)-1){
            echo "<br><input type='submit' name='submit' value='Finalizar'/>";
        }else{
            echo "<br><input type='submit' name='submit' value='Guardar'/>";
        }
        
        echo "</form>";
        echo "<p>".$seleccionados."</p>";
        echo "<p style='color:red'>".$error."</p>";
        ?>
    </body>
</html>
