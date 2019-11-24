<!DOCTYPE html>
<?php 
/*
* RECIVE 
*/
$especies = $this->m_mascotas->sacarEspecies();
$hojadeestilos = base_url()."css/stylesheet.css"
        
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="<?=$hojadeestilos?>" type="text/css">
    </head>
    <body>
        <div id="header">
            <h1>TUS MASCOTAS</h1> 
            <div id="menu">
                <?php
                    $enlace = site_url()."/c_inicial/index";          
                    echo "<a href='$enlace'>Home</a>";
                    if(!isset($_SESSION['username'])){
                        $enlace = site_url()."/c_formularios/iniciar_sesion";
                        echo "<a href='$enlace'>Iniciar sesion</a>";
                        $enlace = site_url()."/c_formularios/registro";                    
                        echo "<a href='$enlace'>Registro</a>";
                    }else{
                        $enlace = site_url()."/c_inicial/desconectarse";
                        echo "<a href='$enlace'>Desconectarse</a>";
                        $enlace = site_url()."/c_formularios/nueva_mascota";
                        echo "<a href='$enlace'>Nueva mascota</a>";
                        $enlace = site_url()."/c_inicial/perfil";
                        echo "<a href='$enlace'>".$_SESSION['username']."</a>";
                    }
                ?>
            </div>
        </div>
        <div id="container">
            <div id="bar">
                <p>Busca por especies:</p>
                <ul>
                    <?php                    
                    foreach ($especies as $especie) {
                        $e = $especie['especie'];
                        $enlace = site_url()."/c_inicial/verEspecie/$e";
                        echo "<li><a href='$enlace'> ".$e."S</a></li>";
                    }
                    ?>
                </ul>
            </div>
