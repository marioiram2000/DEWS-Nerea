<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!--- Zona de preparacion de variables -->
        <?php
         $pregs = array( 
            array("2+2","4"),
            array("Cuerdas de un violin","4"),
            array("Capital de UK","London"),     
            array("7 en binario","111")
        );
                 
        $iactual=0;
        $aciertos=0;
        
        if (isset($_POST['submit'])){
            $iactual =$_GET["iactual"];
            $aciertos=$_POST["aciertos"];
            //comprobar la respuesta correcta: aumentar/no aciertos
            if($_POST['respuesta']==$pregs[$iactual][1]){
                $acertado=true;
                $aciertos ++;
            }
            else 
                $acertado=false;
            //pasar a la siguiente pregunta
            $iactual ++;
         }
        ?>
        <!--- Zona de retroalimentacion -->
        <?php if($iactual>0)
            echo ($acertado?"<p>Respuesta correcta</p>":"<p>Respuesta erronea</p>");  
            echo "<p>";
            echo $aciertos." aciertos de ".$iactual;
            echo "</p>";
        ?>
        
        
        <!--- Zona de formulario -->
        <?php $enlace=$_SERVER['PHP_SELF']."?iactual=".$iactual; ?>
            
        <?php if($iactual < count($pregs)){?>
        <form method="post" action="<?php echo $enlace ?>">
            <input type="hidden" name="aciertos" value="<?php echo $aciertos?>">
            <table>
                <tr>
                    <td><label><?php echo $pregs[$iactual][0]; ?></label></td>
                    <td><input type="text" name="respuesta"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="COMPROBAR">
                    </td>
                </tr>
            </table>
        </form>
        <?php }
        else{
            
        }
        ?>
    </body>
</html>
