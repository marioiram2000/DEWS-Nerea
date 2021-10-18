<?php
require 'bbdd.php';
$con = conexion();
session_start();

$errorSubida = "";
if(isset($_POST['submitimagen'])){
    if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
        $idalimento = $_POST['idalimento'];
        //Pasar a texto el archivo imagen, escapando comillas, etc
        $blobimagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        if(!guardarimagen($con,$idalimento, $blobimagen)){
            $errorSubida = "Ha habido un error a la hora de guardar en el servidor";
        }
    }else{
        $errorSubida = "No se ha podido subir la imagen";
    }
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
        $alims = alimentos3($con);
        
        echo "<table>";
        foreach ($alims as $alim) {
        echo "<tr>";
            echo "<td>".$alim->nombre."</td>";
            if($alim->imagen!=""){
                echo "<td><img src='data:image/jpeg;base64,".base64_encode($alim->imagen)."' width='300px'/></td>";
            }else{
                echo "<td>";
                    echo "<form method='POST' action='".$_SERVER['PHP_SELF']."' enctype='multipart/form-data'>";
                        echo "<input type='file' name='imagen'>";
                        echo "<input type='hidden' name='idalimento' value='$alim->id'>";
                        echo "<input type='submit' name='submitimagen' value='Subir imagen'>";
                    echo "</form>";
                echo "</td>";
            }
        echo "</tr>";
        }
        echo "</table>";
        ?>
    </body>
</html>
