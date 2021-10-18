<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
            function visiestos() {                
                $cont = 0;
                $a = strtotime("2000");
                   
                while ($cont <= 10){
                    if(date("L", $a)==1){
                        $cont ++;
                        echo "<p>".date("Y",$a)."\t $a</p>";
                    }
                    $a += 31556880; //365*24*60*60 = 31536000 + 5*60*60 + 48*60
                    //$a += date("Y", "1");
                }       
            }
        ?>
    </head>
    <body>
        <?php
        visiestos();
        ?>
    </body>
</html>