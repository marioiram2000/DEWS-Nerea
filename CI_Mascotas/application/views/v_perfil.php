<?php
/*
 * Le llega $mascotas, cpn un array de las mascotas de ese usuario
 * Array
(
    [0] => Array(
            [id_mascota] => 11
            [nombre] => salchicho
            [edad] => 1
            [especie] => perrete
            [imagenes] => Array
                (
                    [0] => imagenes/perro_salchicha.jpg
                )
        )
    [1] => Array(
            [id_mascota] => 12
            [nombre] => cuscus
            [edad] => 8
            [especie] => Gato
            [imagenes] => Array
                (
                    [0] => imagenes/cuscus.jpeg
                    [1] => imagenes/cuscus2.jpeg
                )
        )
)
*/
echo "<table>";
$cont = 0;
foreach ($mascotas as $mascota) {
    if($cont==0){echo "<tr>";}       
    echo "<td>";
        echo "<h1>Nombre: ".$mascota['nombre']."</h1><br>";
        foreach ($mascota['imagenes'] as $imagen) {
            echo "<img src='".base_url().$imagen."' alt='tu navegador no soporta el formato de la imagen' width='100' style='margin:5px;'>";
        }
        echo "<br>";        
        echo "Edad: ".$mascota['edad']." años<br>";
        echo "Especie: ".$mascota['especie']."<br>";
        echo anchor(site_url()."/c_formularios/gestionFotos/".$mascota['id_mascota']."/inicio",'Gestionar fotos');
    echo "</td>";
    $cont++;
    if($cont==4){echo "</tr>";$cont=0;}
    
}

echo "</table>";