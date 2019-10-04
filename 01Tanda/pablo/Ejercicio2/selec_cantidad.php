<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Seleccionar cantidad</title>
    </head>
    <body>
        <?php
            define ("DIRIMG", "img");
        
            function cantidad_fotos()
            {
                $cantidad=0;
                $carp= opendir(DIRIMG);
                $arrext=array("jpg","png","gif","tiff");
                
                while($entrada= readdir($carp))
                {
                    $entradapart=explode(".", $entrada);
                    if($entrada!="." && $entrada!=".." && in_array($entradapart[count($entradapart)-1], $arrext))
                    {
                        $cantidad++;
                    }
                }
                closedir($carp);
                return $cantidad;
            }
            
            
            
            
           
            echo "<form method='POST' action='eval_imag.php'>";
                echo "<table>";
                    echo "<tr>";
                        echo "<td>¿Cuantas imágenes deseas ver?</td>";
                        echo "<td><select name='num_img'>";
                            $cantidad=cantidad_fotos();
                            for ($cont=2;$cont<$cantidad;$cont++)
                            {
                                echo "<option value='$cont'>$cont</option>";
                            }
                        echo "</select></td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td><input type='submit' name='submit_cant' value='VER IMAGENES'/>";
                    echo "</tr>";
                echo "</table>";
            echo "</form>"; 
        ?>
        
    </body>
</html>
