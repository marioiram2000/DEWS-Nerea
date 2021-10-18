<?php 
require_once 'bbdd.inc.php';
session_start();
if (!isset($_SESSION['cambios'])) {
    $_SESSION['cambios']=array();
}


$cn=conectarse();

if (isset($_POST['subir'])) {
    subirPrecio($cn, $_POST['plato'], $_POST['cantidad']);
    if (!isset($_SESSION['cambios'][$_POST['plato']])) {
        $_SESSION['cambios'][$_POST['plato']] = 0;
    }
    $_SESSION['cambios'][$_POST['plato']] += $_POST['cantidad'];
}
if (isset($_POST['bajar'])) {
    subirPrecio($cn, $_POST['plato'], $_POST['cantidad']*-1);
    if (!isset($_SESSION['cambios'][$_POST['plato']])) {
        $_SESSION['cambios'][$_POST['plato']] = 0;
    }
    $_SESSION['cambios'][$_POST['plato']] -= $_POST['cantidad'];
}
print_r($_SESSION['cambios']);


$platos=array();
$tipoElegido="";
if (isset($_REQUEST['tipo'])){
    $platos= platosTipo($cn, $_REQUEST['tipo']);
    $tipoElegido = $_REQUEST['tipo'];
}
?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $tipos = tiposPlatos($cn);
        
        
        echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
        foreach ($tipos as $tipoPlato) {
            echo '<input type="radio" name="tipo" value="'.$tipoPlato.'">'.$tipoPlato;
        }
        echo "<input type='submit' name='submittipo' value='Ver platos'>";
        echo "</form>";
        
        
        echo "<br>";
        echo "<table>";
        foreach ($platos as $plato) {
            echo '<form action="'.$_SERVER['PHP_SELF'].'?tipo='.$tipoElegido.'" method="POST">';
            echo "<tr>";
            echo "<td>".$plato->nombre."</td>";
            echo "<td>".$plato->precio."</td>";
            echo "<td><input type='number' name='cantidad'</td>";
            echo "<td><input type='submit' name='subir' value='+'></td>";
            echo "<td><input type='submit' name='bajar' value='-'></td>";
            echo "<input type='hidden' name='plato' value='".$plato->idplato."'>";
            echo "<tr>";
            echo "</form>";
        }
        echo "</table>";
        
        if (count($_SESSION['cambios'])>0) {
            echo "<p><a href='mailprecios.php'>Enviar informe administrador</a></p>";
        }
        ?>
        
            
        
    </body>
</html>
