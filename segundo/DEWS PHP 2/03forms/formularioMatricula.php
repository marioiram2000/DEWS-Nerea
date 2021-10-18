<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <title></title>
    </head>
    <body>
        <?php
            $modulos = array("LEMA","SIST","PROG","BBDD","ENDE","FOL","ING");
            
            $dni = "";
            $dw1aS="";
            $dw1bS="";
            
            $errorDni = "";
            $errorCurso = "";
            $errorModulos = "";
            
            if(isset($_POST['submit'])){
                $dni = $_POST['dni'];
                if(empty($dni) && strlen($dni)!=9){
                    $errorDni = "DNI con letra (9 carácteres)";
                }
                
                if(!isset($_POST['curso'])){
                    $errorCurso = "Selecciona algun curso";
                }else{
                    $curso = $_POST['curso'];
                    if($curso=="DW1A"){
                        $dw1aS = "checked";
                    }if($curso=="DW1B"){
                        $dw1bS = "checked";
                    }
                }
                
                if(!isset($_POST['modulos'])){
                    $errorModulos = "Debes marcar algún módulo";
                }else{
                    $modulosS=$_POST['modulos'];
                    
                }
            }
            
            
            
        ?>
        <div class="container position-sticky">
            <form class="border-top" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                <table class="table ">
                    <thead class="thead-dark"><tr><th colspan="3">MATRÍCULA</th></tr></thead>
                    <tr>
                        <td >DNI</td>
                        <td>
                            <input type="text" name="dni" value="<?php echo $dni?>">                                             
                        </td>
                        <td><span style='color:red' class="ml-0"><?php echo $errorDni?></span>      </td>
                    </tr>
                    <tr>
                        <td>CURSO</td>
                        <td>
                            DW1A <input type="radio" name="curso" value="DW1A" <?php echo $dw1aS?>> 
                            DW1B <input type="radio" name="curso" value="DW1B" <?php echo $dw1bS?>>                            
                        </td>
                        <td><span style='color:red' class="ml-0"><?php echo $errorCurso?></span>       </td>
                    </tr>
                    <tr>
                        <td>Módulos</td>
                        <td>
                            <?php
                                foreach ($modulos as $value) {
                                    if(isset($modulosS) && in_array($value, $modulosS)){
                                        echo "<p>$value <input type='checkbox' name='modulos[]' value='$value' checked></p>";
                                    }else{
                                        echo "<p>$value <input type='checkbox' name='modulos[]' value='$value'></p>";
                                    }
                                    
                                }
                            ?>
                            
                        </td>
                        <td><span style='color:red' class="ml-0"><?php echo $errorModulos?></span></td>
                    </tr>
                    <tr><td colspan="3"><input type="submit" name="submit" class="btn btn-primary" value="Submit"></td></tr>
                </table>
            </form>
        </div>
        
    </body>
</html>
