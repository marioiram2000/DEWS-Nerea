<?php
function conectarse() {
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_DATABASE", "bdsubastas");
    $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    if (mysqli_connect_errno()> 0 ) {
        die("Acceso denegado BBDD");
    }
    return $cn;
}