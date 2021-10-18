<html>
    <head>
        <meta charset="UTF-8">
        <title>Pruebas</title>
    </head>
    <body>
        <ul>            
        <?php
            $h1 = strtotime("15:40"); 
            $h2 = strtotime("24:00");
            $i = 2400;
            if($h1<$h2){
                while ($h1<$h2){
                    echo "<li>". date("H:i", $h1)."</li>";
                    $h1+=$i;
                }
            }else{
                while ($h1>$h2){
                    echo "<li>". date("H:i", $h1)."</li>";
                    $h1+=$i;
                }
            }
            echo "<li>". date("H:i", $h2). "</li>";
        ?>
        </ul>
    </body>
</html>
