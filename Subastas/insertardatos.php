<?php

include './bbdd.config.php';
$cn = conectarse();

//zona de declaración de datos
$insertCategorias = 
        'insert into categorias (categoria) values ("joyas");'
        .'insert into categorias (categoria) values ("motos");'
        .'insert into categorias (categoria) values ("coches");';

$insertUsuarios = 
'insert into usuarios (username, password, email, cadenaverificacion, activo) values ("mario", "123", "marioiram2000@gmail.com", "132", 1);';

$fecha = "to_date('10/01/2020', 'dd/mm/yyyy')";
$insertItems = 
        'insert into items (id_cat, id_user, nombre, preciopartida, descripcion, fechafin) values ("coches", "1", "Ferrari", "3", "Coche ferrari seminuevo, de 0 a 100 en 10 mins", "$fecha");';

$insertPujas =
        'insert into pujas (id_item, id_user, cantidad) values (1, 1, 5)';

$insertImagenes = 
        'insert into imagenes (id_item, imagen) values (1,"imagenes/ferrari.jpg")';

//zona de inerción de los datos

function ejecutarSentencia($cn, $sql){
    $cn->query($sql);
    if ($cn->affected_rows==0)
        return false;
    else 
        return true;
}
ejecutarSentencia($cn, $insertCategorias);
ejecutarSentencia($cn, $insertUsuarios);
ejecutarSentencia($cn, $insertItems);
ejecutarSentencia($cn, $insertPujas);
ejecutarSentencia($cn, $insertImagenes);