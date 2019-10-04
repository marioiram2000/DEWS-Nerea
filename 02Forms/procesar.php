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
            if (!isset($_POST['submit']))
            {
               header ("location: index.php");
            }
            else
            {
                
               $nombre = $_POST['nombre'];
               $sexo="desconocido";
               if (isset ($_POST['sexo']))
               {
                   $sexo=$_POST['sexo'];
               }
               $aficiones="ninguna";
               if (isset ($_POST['aficiones']))
               {
                   $aficiones=implode (",",$_POST['aficiones']);
               }
               $ciudad=$_POST['ciudad'];
               $edades_hijos=$_POST['edadeshijos'];
               
               echo "<p> Nombre: ".$nombre."</p>";
               echo "<p> Sexo: ".$sexo."</p>";
               echo "<p> Aficiones: ".$aficiones."</p>";
               echo "<p> Ciudad: ".$ciudad."</p>";
               
               echo "<p>Edades de los hijos:</p>";
               foreach ($edades_hijos as $edad)
               {
                   if(is_numeric($edad))
                    echo $edad."</br>";
                   else
                    echo "Edad desconocida</br>";
               }
            }

        ?>
    </body>
</html>
