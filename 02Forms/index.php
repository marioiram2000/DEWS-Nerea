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
           $hijos=array("Edad hijo 1","Edad hijo 2","Edad hijo 3","Edad hijo 4");
        ?>
         
        <form action="procesar.php" method="POST">
            <p> Nombre: <input type="text" name="nombre"/></p>
            <p>Sexo: Hombre <input type="radio" name="sexo" value="h"/>
                Mujer <input type="radio" name="sexo" value="m"/></p>
            <p>Elige aficiones: 
                Leer<input type="checkbox" name="aficiones[]" value="Leer"/>
                Cine<input type="checkbox" name="aficiones[]" value="Cine"/>
                Deporte<input type="checkbox" name="aficiones[]" value="Deporte"/>
                Juegos<input type="checkbox" name="aficiones[]" value="Juegos"/></p>
            <p>Ciudad de residencia:
                <select name="ciudad">
                    <option value="Vitoria">Vitoria</option>
                    <option value="Bilbao" selected>Bilbao</option>
                    <option value="Barcelona">Barcelona</option>
                    <option value="Valencia">Valencia</option>
                    <option value="Miranda">Miranda</option>
                </select></p>
            <p>
                <?php
                    echo "<table>";
                    foreach($hijos as $hijo)
                    {
                        echo "<tr>";
                        echo "<td>".$hijo."</td>";
                        echo "<td><input type='text' name='edadeshijos[]' /></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                ?>
            </p>
            
            
            
            

            <p><input type="submit" name="submit" value="Enviar"/></p>
        </form>
    </body>
</html>
