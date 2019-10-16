<?php
//FUNCION PARA CONECTARSE A LA BASE DE DATOS
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
//FUNCION PARA SACAR TODAS LAS CATEGORIAS DE LA TABLA CATEGORIAS
function sacarCategorias($cn){
    $todasCategorias = array();
    $sql = "select * from categorias";
    $rs = $cn->query($sql);
    while ($fila=$rs->fetch_object()){     
        $todasCategorias[]=$fila;
    }
    return $todasCategorias;
}

//FUNCION PARA SACAR id, nombre, preciopartida, fechafin DE LOS ITEMS DE LA BASE DE DATOS ---> DATOS PARA EL INDEX
function sacarItemsIndex($cn, $categoria){
    $todositems = array();
    if($categoria=="todas"){
        $sql = "select id, nombre, preciopartida, fechafin from items";
    }else{
    $sql = "select id, nombre, preciopartida, fechafin from items where id_cat='$categoria'";
    }
    $rs = $cn->query($sql);
    while ($fila=$rs->fetch_object()){     
        $todositems[]=$fila;
    }
    return $todositems;
}

//FUNCION A LA QUE SE LE PASA UN ID DE UN ITEM Y DEVUELVE LA RUTA DE LA IMAGEN
function sacarImagen($cn, $id_item){
    $sql = "select imagen from imagenes where id_item='$id_item'";
    $rs = $cn->query($sql);
    $imagen = $rs->fetch_object();
    if($rs->num_rows == 0){
        return "";
    }
    return $imagen->imagen;
}

//FUNCION QUE RECIVE UN ID DE UN ITEM Y DEVUELVE LA CANTIDAD DE PUJAS QUE HAY
function sacarPujas($cn, $id_item){
    $sql = "select count(*) cont from pujas where id_item='$id_item'";
    $rs = $cn->query($sql);
    $cont = $rs->fetch_object();
    return $cont->cont;
}

//FUNCION QUE RECIVE UN ID DE UN ITEM Y DEVUELVE LA PUJA MÁS ALTA
function pujaMasAlta($cn, $id_item){
    $cont = sacarPujas($cn, $id_item);
    if($cont == 0){
        $sql2 = "select preciopartida from items where id = '$id_item'";
        $rs2 = $cn->query($sql2);
        $preciopartida = $rs2->fetch_object();
        return $preciopartida->preciopartida;
    }
    $sql = "select max(cantidad) max from pujas where id_item='$id_item'";
    $rs = $cn->query($sql);
    $max = $rs->fetch_object();
    $row_cnt = $rs->num_rows;
    return $max->max;
}

//FUNCION QUE RECIVE UN ID DE UN ITEM Y DEVUELVE LA FECHA FINAL
function sacarFecha($cn, $id_item){
    $sql = "select fechafin from items where id='$id_item'";
    $rs = $cn->query($sql);
    $fecha = $rs->fetch_object();
    if($rs->num_rows == 0){
        return "";
    }
    return $fecha->fechafin;
}

//funcion que COMPRUEBA los DATOS de los REGISTROS
function comprobarUsu($cn, $usu, $ps1, $ps2, $email){
    $existe = existeUsu($cn, $usu);
    if($usu==""||$ps1==""||$email==""){
        return "<p style='color: red;'>Debes rellenar todos los campos.</p> ";
    }
    if($existe){
        return "<p style='color: red;'>Ese usuario ya existe.</p> ";
    }
    if($ps1!=$ps2){
        return "<p style='color:red'>Las contraseñas no coinciden.</p> ";
    }
}

//funcion que recive un NOMBRE DE USUARIO y devuelve si EXISTE o no
function existeUsu($cn, $usuario){
    $sql = "select id from usuarios where username='$usuario'";
    $rs = $cn->query($sql);
    if($rs->num_rows == 0){
        return false;
    }
    return true;
}