<?php

define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "bdsubastas");
define("IMAGENES", "imagenes/");
define("RUTA", "http://localhost/08Subastas/");
define("DIVISA", "€");
date_default_timezone_set("Europe/Madrid");


function conexion(){
    $link = mysqli_connect(HOST, USER, PASS, DB);
    if(mysqli_errno($link)>0){
        return false;
    }
    return $link;
}
