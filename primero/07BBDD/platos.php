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
         
         $cn=conectarse();
         
         
         if (isset($_POST['submitplato'])){
             echo "CASO 1";
             $contenidoFoto=null;
             if (is_uploaded_file($_FILES['foto']['tmp_name'])){
                 $contenidoFoto=addslashes(file_get_contents($_FILES['foto']['tmp_name']));  
             }
             grabarPlato($cn, $_POST['nombre'],$_POST['precio'], $_POST['calorias'], $contenidoFoto );
         }
         else{
             echo "CASO 2";
         }
         
         
         
         
         $todosplatos=platos($cn);
         
         echo "<table>";
         foreach ($todosplatos as $arrplato){
             
             echo "<tr>";
             echo "<td>".$arrplato['nombre']."</td>";
             echo "<td>".$arrplato['precio']." €</td>";
             echo "<td>".$arrplato['calorias']." calorias</td>";
             //DIBUJAR IMAGEN BLOB $arrplato['foto']
             if ($arrplato['foto'])
                echo "<td><img width='30' src='data:image/jpeg;base64,".base64_encode($arrplato['foto'])."'/></td>";
             else
                 echo "<td>SIN FOTO</td>";
             echo "</tr>";
         }
         echo "</table>";
         
         
         echo "<p>NUEVO PLATO</p>";
         echo "<form method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'>";
         echo "<input type='hidden' name='MAX_FILE_SIZE' value='90000' />";
         echo "Nombre: <input type='text' name='nombre' />";
         echo "Precio: <input type='text' name='precio' />";
         echo "Calorias: <input type='text' name='calorias' />";
         echo "Foto:<input type='file' name='foto' />";
         echo "<p><input type='submit' name='submitplato' value='NUEVO PLATO' />";
         echo "</form>";
         
         
         
        ?>
    </body>
</html>
