<?php
    require 'bbdd.php';
    $con = conexion();
    if(!$con){
        die("<br>Conexion erronea</br>");
    }
    
    if(isset($_POST['submitinsert'])){
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $tipo = $_POST['tipo'];
        
        insertarAlimentoAhora($nombre,$precio,$tipo, $con);
    }
    $n = -1;
    if(isset($_GET['actualizar'])){
        $n = actualizarAlimentosAntiguos($con);
    }
    if(isset($_POST['submittipo'])){
        $alimsTipo = alimentos($con, $_POST['tipo']);
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2><a href="<?php echo $_SERVER['PHP_SELF']."?actualizar"?>">Actualizar alimentos antiguos</a></h2>
        <?php
        if(isset($_GET['actualizar'])){
            echo "<p>$n alimentos alctualizados</p>";
        }
        ?>
        <p>AÑADIR ALIMNENTO</p>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
            <label>Nombre: </label> <input type="text" name="nombre">
            <label>Precio: </label> <input type="text" name="precio">
            <label>Tipo: </label>
            <select name="tipo">
                <option value="PRIMERO">PRIMERO</option>
                <option value="SEGUNDO">SEGUNDO</option>
                <option value="POSTRE">POSTRE</option>
            </select>
            <input type="submit" name="submitinsert" value="ACEPTAR">
        </form>
        
        <h2>ALIMENTOS</h2>
        <?php
        $alims = alimentos($con);
        echo "<table>";
        foreach ($alims as $alim) {
            $fecha = date("d-M-y", strtotime($alim['fecha']));
            echo "<tr>";
                echo "<td>".$alim['id']."</td>";
                echo "<td>".$alim['nombre']."</td>";
                echo "<td>".$alim['precio']."</td>";
                echo "<td>".$alim['tipo']."</td>";
                echo "<td>".$fecha."</td>";
            echo "</tr>";
            
        }
        echo "</table>";
        ?>
        
        <h2>Ver alimentos por tipo</h2>
        <?php
        $tipos = tipos($con);        
        echo '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
        foreach ($tipos as $tipo) {
            echo "<input type='radio' name='tipo' value='$tipo'>".$tipo;
        }
        echo "<input type='submit' name='submittipo' value='Ver alimentos'>";
        echo "</form>";
        echo '<table>';
        if(isset($alimsTipo)){
            foreach ($alimsTipo as $alim) {
                $fecha = date("d-M-y", strtotime($alim['fecha']));
                echo "<tr>";
                    echo "<td>".$alim['id']."</td>";
                    echo "<td>".$alim['nombre']."</td>";
                    echo "<td>".$alim['precio']."</td>";
                    echo "<td>".$alim['tipo']."</td>";
                    echo "<td>".$fecha."</td>";
                echo "</tr>";

            }
        }
        echo '</table>';
        ?>
        
        
    </body>
</html>
