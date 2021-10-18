<?php
/*
 * Le llega $cines 
 */
$optionsDia=array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,13=>13,14=>14,15=>15,16=>16,17=>17,18=>18,19=>19,20=>20,21=>21,22=>22,23=>23,24=>24,25=>25,26=>26,27=>27,28=>28,29=>29,30=>30,31=>31,);
$optionsMes=array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12);
$fecha = date("Y");
$fecha2 = $fecha+1;
$optionsAno=array($fecha=>$fecha, $fecha2=>$fecha2);
?>


<h1>Elija fecha</h1>
<table>
    <tr><th>Día</th><th>Mes</th><th>Año</th><th>Cine</th></tr>
<?php

echo form_open(site_url()."/c_cines/index");
    echo "<tr>";
        echo "<td>".form_dropdown("dia", $optionsDia)."</td>";
        echo "<td>".form_dropdown("mes", $optionsMes)."</td>";
        echo "<td>".form_dropdown("ano", $optionsAno)."</td>";
        echo "<td>";
        foreach ($cines as $cine) {
            echo form_radio("cine[]", $cine);
            echo form_label($cine);
        }
        echo form_error('cine[]')."</td>";
    echo "</tr>";
    echo "<tr><td colspan='4'>".form_submit('submit', 'VER PELICULAS')."</td></tr>";
echo form_close();
?>
</table>