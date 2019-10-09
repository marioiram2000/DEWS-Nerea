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
            include_once 'bbdd.inc.php';
            $cn = conectarse();
            
            if(isset($_POST['submitPlato'])){
                $contenidoFoto=null;
                if(is_uploaded_file($_POST['foto']['tmp_name'])){
                    $contenidoFoto= addslashes(file_get_contents($_FILES['foto']['tmp_name']));
                    
                }
                grabarPlato($cn, $_POST['nombre'],$_POST['precio'],$_POST['calorias'],$contenidoFoto);
                
            }
            
            echo 'TODOS LOS PLATOS:';            
            $todosPlatos= platos($cn);
            echo '<table>';
            foreach ($todosPlatos as $arrPlato) {
              echo '<tr>';
                echo "<td>".$arrPlato['nombre']."</td>";
                echo "<td>".$arrPlato['precio']."€</td>";
                echo "<td>".$arrPlato['calorias']." calorias</td>";
                if($arrPlato['foto']){
                    echo "<td><img width=30 src='data:image/jpeg/;base64,'". base64_encode($arrPlato['foto'])."/></td>";
                }
                else{
                    echo "<td>SINFOTO</td>";
                }
              echo '</tr>';
            }
            echo '</table>';
            echo "<br>";
            
            echo "<p>NUEVO PLATO</p>";
            echo "<form method='post' enctype='multipart/from-data' action='".$_SERVER['PHP_SELF']."'>";
                echo "<input type='text' name='nombre'/><br>";
                echo "<input type='text' name='precio'/><br>";
                echo "<input type='text' name='calorias'/><br>";
                echo "<input type='file' name='foto'/><br>";
                echo "<input type='submit' name='submitPlato' value='NUEVO PLATO'/><br>";
            echo "</form>";
            
        ?>
    </body>
</html>
