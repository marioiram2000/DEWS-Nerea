<?php
echo "<h2>".$this->session->userdata('empleado')->nombre."</h2>";
echo "<hr>";

echo "<p>".$this->session->flashdata('rtdodevolucion')."</p>";

echo "<table>";
foreach ($prestamos as $prestamo) {
    echo "<tr>";
        echo "<td>$prestamo->titulo</td>";
        echo "<td>$prestamo->fecha</td>";
        
        if(! $prestamo->fechadevolucion){
            if(in_array($prestamo->idprestamo, $this->session->userdata('idsprestamos'))){
                echo "<td>Devolucion anotada</td>";
            }else{
                $enlace = site_url()."/c_devoluciones/anotarDevolucion/".$prestamo->idprestamo;
                echo "<td><a href='$enlace'>Anotar devolucion</a></td>";
            }
        }else{
            echo "<td>$prestamo->fechadevolucion</td>";
        }
    echo "</tr>";
}
echo "</table>";

if(count($this->session->userdata('idsprestamos'))>0){
    $enlace = site_url()."/c_devoluciones/grabarDevoluciones";
    echo "<a href='$enlace'>Grabar devoluciones</a>";
}