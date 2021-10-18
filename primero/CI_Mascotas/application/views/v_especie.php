<?php
//le llega $imagenes y $especie
//$imagenes = Array ( [0] => Array ( [ruta] => imagenes/gato_egipcio.jpg ) [1] => Array ( [ruta] => imagenes/cuscus.jpeg ) [2] => Array ( [ruta] => imagenes/cuscus2.jpeg ) )
$cont = 0;
echo '<table>';
    foreach ($imagenes as $imagen) {
    if($cont==0){echo "<tr>";}       
    echo "<td>";        
        echo "<img src='".base_url().$imagen['ruta']."' alt='tu navegador no soporta el formato de la imagen' width='100' style='margin:5px;'>";       
    echo "</td>";
    $cont++;
    if($cont==4){echo "</tr>";$cont=0;}
    
}
echo '</table>';

