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
            $texto="";
            $error="";
            
            
            $seleceuros="checked";
            $selecdolares="";
            
            $cajatexto="";
            $opcion="";
            $cambio="";
            function sacar_cambio()
            {
                $f= fopen("conversion.txt", 'r');
                $linea= fscanf($f, "%g\n");
                return $linea[0];
            }
            if (isset($_POST['cambio']))
            {
                $cambio=sacar_cambio();
                $cajatexto=$_POST['dinero'];
                $opcion=$_POST['cambio'];
                if($opcion=="euros_a_dolares")
                {
                    $seleceuros="checked";
                    $selecdolares="";
                }
                else
                {
                    $selecdolares="checked";
                    $seleceuros="";
                }
                
                if($cajatexto=="")
                {
                    $error="¡VACIO!";
                }
                else
                {
                    if(!is_numeric($cajatexto))
                    {
                        $error="¡NO NUMERICO!";
                        $cajatexto="";
                    }
                    else 
                    {
                        if($opcion=="euros_a_dolares")
                        {
                            $texto=$cajatexto*$cambio;
                        }
                        else
                        {
                            $texto=$cajatexto/$cambio;
                        }
                    }
                }
            }
        ?>
        
        <form action=<?php echo $_SERVER['PHP_SELF'] ?> method="POST">
            <table>
                <tr>
                    <td rowspan="2">Cantidad:<input type="text" name="dinero" value="<?php echo $cajatexto ?>"/></td>
                    <?php
                    if ($error!="")
                        echo "<td rowspan='2'>$error</td>";
                    echo "<td><input type='radio' name='cambio' value='euros_a_dolares' $seleceuros/>Euros a dólares</td>";
                    ?>
                </tr>
                <tr>
                    <?php echo "<td><input type='radio' name='cambio' value='dolares_a_euros' $selecdolares />Dólares a euros</td>"?>
                </tr>
                <?php
                    if ($texto!="")
                    {
                        echo "<tr>";
                            echo "<td>".$texto." €</td>";
                        echo "</tr>";
                    }
                ?>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="CONVERTIR"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
