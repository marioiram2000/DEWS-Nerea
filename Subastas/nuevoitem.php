<?php
include './cabecera.php';
include './barra.php';

$_SESSION['actual']="http://localhost/Subastas/nuevoitem.php";
if(!isset($_SESSION['id_user'])){
    header("Location: http://localhost/Subastas/login.php");
}

$diasEnElMes = ["31","28","31","30","31","30","31","31","30","31","30","31"];

$nombre = "";
$descripcion = "";
$precio = "";
if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['$precio'];
}

?>

<h1>Añade un nuevo item</h1>
<h3><strong>Paso 1 </strong>- Añade detalles del item</h3>

<form>
    <table border="1">
        <tr>
            <th>Categoria</th>
            <td></td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td><input type="text" name="nombre" value="<?php echo $nombre; ?>"></td>
        </tr>
        <tr>
            <th>Descripción</th>
            <td  height="300px" width="500px"><textarea name="nombre" height="300px" width="500px"> <?php echo $descripcion; ?> </textarea>></td>
        </tr>
        <tr>
            <th>Fecha de fin para pujar</th>
            <td>
                <table border="1">
                    <tr><th>Día</th><th>Mes</th><th>Año</th><th>Hora</th><th>Minutos</th></tr>
                    <tr>
                        <?php
                            $aDia = date("d");
                            $aMes = date("m");
                            $aAño = date("y");
                            $aHora = date("H");
                            $aMinutos = date("i");
                        ?>
                    </tr>
                </table>
                
            </td>
        </tr>
        <tr>
            <th>Precio</th>
            <td><input type="text" name="nombre" value="<?php echo $precio; ?>">€</td>
        </tr>
    </table>
</form>



<?php
include './pie.php';
?>