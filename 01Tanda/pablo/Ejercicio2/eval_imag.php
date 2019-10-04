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
            define ("DIRIMG", "img");
            
            $partes=0;
            
            $fotos=array();
            $rutas=array();
            
            $like_enlaces=array();
            function rutas_imag()
            {
                $rutas=array();
                $carp= opendir(DIRIMG);
                
                while($entrada= readdir($carp))
                {
                    if($entrada!="." && $entrada!="..")
                    {
                        $rutas[]=DIRIMG."/".$entrada;
                    }
                }
                closedir($carp);
                return $rutas;
            }

            function aniadir_a_fich($arr,$nomfich)
            {
                $f=fopen($nomfich,'a');
                $cadena=$_SERVER['REMOTE_ADDR'].":\t";
                for ($i=0;$i<count($arr);$i++)
                {
                    $cadena.=$arr[$i]." ";
                }
                $cadena.="\n";
                fputs($f,$cadena);
                fclose($f);
            }
            
            if (isset($_POST['submit_cant']))
            {
                $partes=1;
                $rutas=rutas_imag();
                $fotos= array_rand($rutas,$_POST['num_img']);
                
            }
            
            if(isset($_POST['submit_like']))
            {
                $partes=2;
                if(isset($_POST['me_gusta']))
                {
                    $like_enlaces=$_POST['me_gusta'];
                    if(count($like_enlaces!=0))
                        aniadir_a_fich($like_enlaces,"likes.txt");
                }
                
            }
            
            if ($partes==1)
            {
        ?>
                <form action=<?php echo $_SERVER['PHP_SELF']?> method="POST">
                    <table border='1' rules=none frame=box>
                        <?php
                            for ($i=0;$i<count($fotos);$i++)
                            {
                                echo "<tr>";
                                    echo "<td><img src='".$rutas[$fotos[$i]]."' height='50' width='60'></td>";
                                    echo "<td><input type='checkbox' name='me_gusta[]' value='". substr($rutas[$fotos[$i]], 4)."'/>Me gusta</td>";
                                echo "</tr>";
                            }
                            echo "<tr>";
                                echo "<td colspan=2><input type='submit' name='submit_like' value='ENVIAR VALORACIONES'/></td>";
                            echo "</tr>";
                        ?>
                    </table>
                </form>
        <?php
            }
            else
                if($partes==2)
                {
                    if(count($like_enlaces)!=0)
                    {
                ?>
                    <table border='1' rules=none frame=box>
                        <tr>
                            <td>
                                Gracias por tu envio
                            </td>
                        </tr>
                        <tr>
                            <td><a href="selec_cantidad.php">Volver a la pagina de seleccion</td>
                        </tr>
                    </table> 
                <?php
                    }
                    else
                    {
                        ?>
                        <table border='1' rules=none frame=box>
                            <tr>
                                <td>
                                    Lamentamos que no te haya gustado ninguna
                                </td>
                            </tr>
                            <tr>
                                <td><a href="selec_cantidad.php">Volver a la pagina de seleccion</td>
                            </tr>
                        </table>  
        
                        <?php
                    }
                }
        ?>
    </body>
</html>
