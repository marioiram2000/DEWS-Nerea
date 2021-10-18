<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        $n = "";
        $cant = "";
        $inc = "";
        $numS = "";
        $numN = "";
        
        $errorN = "";
        $errorC = "";
        $errorO = "";
        
        $dibujar = false;
        
        if(isset($_POST['submit'])){
            $n = $_POST['n'];
            $cant = $_POST['cant'];
            $inc = $_POST['incremento'];
            
            
            if($n == "" || !is_numeric($n)){
                $errorN = "Debes introducir un numero";
            }
            
            if($cant == "" || !is_numeric($cant)){
                $errorC = "Debes introducir un numero";
            }
            
            if (isset($_POST['numerada'])){
                if($_POST['numerada']=="si"){
                    $numS = "checked";
                }else if($_POST['numerada']=="no"){
                    $numN = "checked";
                }                
            }else{
                $errorO = "Debes seleccionar alguna de las opciones";
            }
            
            if(isset($_POST['numerada']) && $errorN == "" && $errorC == "" && $errorO == ""){
                $dibujar = true;
            }
        }
        ?>
        <div class="container">
            <div class="container">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <div class="form-group">
                      <label for="n">Nº inicio <span style='color:red'><?php echo $errorN?></span></label>
                      <input type="text"  class="form-control" name="n" id="n" value="<?php echo $n?>"/>
                      
                    </div>
                    <div class="form-group">
                      <label for="cant">Cantidad <span style='color:red'><?php echo $errorC?></span></label>
                      <input type="text" class="form-control"  name="cant" id="cant"   value="<?php echo $cant?>">
                    </div>
                    <div class="form-group">
                       <label>Incremento</label>
                       <select name="incremento">
                            <?php
                                for ($i = 5; $i < 100; $i+=5) {
                                    if ($i==$inc){
                                        echo "<option value='$i' class='form-control' selected>$i</option>";
                                    }else{
                                        echo "<option value='$i' class='form-control'>$i</option>";
                                    }
                                    
                                }
                            ?>
                        </select>    
                    </div>
                    <div class="form-group form-check">
                        <label>Desea la lista numerada o sin numerar?  <span style='color:red'><?php echo $errorO?></span></label>
                        <br>
                        <label class="form-radio-label">No numerada</label>
                        <input type="radio" class="form-radio-input" name="numerada" value="no" <?php echo $numN ?>>

                        <br>
                        <label class="form-radio-label">Numerada</label>
                        <input type="radio" class="form-radio-input" name="numerada" value="si" <?php echo $numS ?>>

                    </div>

                    <button type="submit" class="btn btn-primary" name="submit">Dibujar</button>
                </form>
            </div>

            <div class="container">
            <?php
                if($dibujar){
                    if($_POST['numerada']=="si"){
                        echo "<ol>";
                        for ($i = 0; $i < $cant; $i++) {
                            echo "<li>$n</li>";
                            $n += $inc;
                        }
                        echo "</ol>";
                    }else{
                        echo "<ul>";
                        for ($i = 0; $i < $cant; $i++) {
                            echo "<li>$n</li>";
                            $n += $inc;
                        }
                        echo "</ul>";
                    }
                }
            ?>
            </div>
        </div>
    </body>
</html>
