<?php
include './cabecera.php';
include './barra.php';

$_SESSION['actual']="http://localhost/Subastas/nuevoitem.php";
if(!isset($_SESSION['id_user'])){
    header("Location: http://localhost/Subastas/login.php");
}

$nombre = "";
$descripcion = "";
$precio = "";
$aAnio = date("Y");
$errorFecha = "";
$errorPrecio = "";

if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
       
    //Comprobación de la fecha introducida
    $iDia = $_POST['dia'];
    $iMes = $_POST['mes'];
    $iAnio = $_POST['anio'];
    $iHora = $_POST['hora'];
    $iMinutos = $_POST['minutos'];
    
    $fecha_introducida = strtotime($iDia."-".$iMes."-".$iAnio." ".$iHora.":".$iMinutos.":00" );
    $fecha_actual = strtotime(date("d-m-Y H:i",time()));
    if($fecha_introducida<$fecha_actual){
        $errorFecha .= "<p style='color:red'>Fecha incorrecta.</p>";
    }
    
    //Comprobación del nombre
    /*
     * 
     * 
     * 
     * 
     * 
     */
    
    //Comprobación del precio
    if(!is_numeric($precio)){
        $errorPrecio .= "<p style='color:red'>Precio incorrecto.</p>";
    }
    
    if($errorFecha == "" && $errorPrecio == ""){    
        $strfecha=$iAnio."-".$iMes."-".$iDia." ".$iHora.":".$iMinutos.":00";
        echo $strfecha;
        $idItem = aniadirItem($cn, $id_cat, $_SESSION['id_user'], $nombre, $precio, $descripcion,  $strfecha);
        if($idItem!=false){
            //echo "----------------------------------------------------------idItem: $idItem-----------------------------------------------";
            header("Location:aniadeimagenes.php?idItem=$idItem");
        }else{
            echo "<p style='color:red'>Ha ocurrido algo inesperado y el item no se ha podido añadir</p>";
        }
    }
    
}

?>

<h1>Añade un nuevo item</h1>
<h3><strong>Paso 1 </strong>- Añade detalles del item</h3>
<form name="nuevoItem" method="POST" action="<?php echo $_SESSION['actual']; ?>">
    <table border="1">
        <tr>
            <th>Categoria</th>
            <td>
                <select name="categoria">
                <?php
//En la barra ya he sacado las categorias, reutilizo la variable
                foreach ($todasCategorias as $categoria) {
                    echo "<option value='$categoria->categoria'>$categoria->categoria</option>";
                }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td><input type="text" name="nombre" value="<?php echo $nombre; ?>"></td>
        </tr>
        <tr>
            <th>Descripción</th>
            <td><input type="text" name="descripcion" value="<?php echo $descripcion; ?>"></td>
        </tr>
        <tr>
            <th>Fecha de fin para pujar</th>
            <td>
                <table border="1">
                    <tr><th>Día</th><th>Mes</th><th>Año</th><th>Hora</th><th>Minutos</th><?php echo $errorFecha; ?></tr>
                    <tr>
                        <td>
                            <select name="dia">
                                <?php
                                for ($i = 1; $i <= 31; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="mes">
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="anio">
                                <?php
                                for ($i = $aAnio; $i <= $aAnio+5; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="hora">
                                <?php
                                for ($i = 1; $i <= 24; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="minutos">
                                <?php
                                for ($i = 0; $i <= 59; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                
            </td>
        </tr>
        <tr>
            <th>Precio </th>
            <td><?php echo $errorPrecio; ?><input type="text" name="precio" value="<?php echo $precio; ?>">€</td>
        </tr>
    </table>
    <input type="submit" value="Añadir" name="submit">
</form>



<?php
include './pie.php';
?>