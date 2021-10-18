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
            $afi = array("surf", "videojuegos", "ciclismo", "alcohol");
        ?>
        <div class="container">
            <form action="proceso.php" method="POST" class="border-top">
            <div class="form-group">
              <label for="nom">Nombre</label>
              <input type="text" name="nom" id="nom"/>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
               <label>Edad</label>
               <select name="edad">
                    <?php
                        for ($i = 1; $i < 100; $i++) {
                            echo "<option value='$i' class='form-control'>$i</option>";
                        }
                    ?>
                </select>              
            </div>
            <div class="form-group form-check">
                <label>Sexo</label><br>
                <label class="form-radio-label">H</label>
                <input type="radio" class="form-radio-input" name="sexo" value="h">
                
                <br>
                <label class="form-radio-label">M</label>
                <input type="radio" class="form-radio-input" name="sexo" value="m">
                
            </div>
            <div>
                <label>Aficiones</label>
                <?php
                    foreach ($afi as $aficion) {
                        echo "$aficion <input type='checkbox' name='aficiones[]' value='$aficion'/></br>";
                    }
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </body>
</html>
