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

//Funcion que devuelve SI un ITEM ha recibido alguna PUJA o NO
function pujado($cn, $id_item){
    $sql = "select id from pujas where id_item=$id_item";
    $rs= $cn->query($sql);
    if($rs->num_rows==0){
        return false;
    }
    return true;
}

//Funcion que comprueba si una fecha está pasada
function comprobarFechaVencida($fecha){
    $fecha_actual = strtotime(date("d-m-Y H:i",time()));
    $fecha_fin = strtotime($fecha);
    if($fecha_actual>$fecha_fin){
        return true;
    }
    return false;
}
//Funcion que devuelve un array de items no pujados
function sacarItemsNoPujados($cn){
    $itemsVencidos = array();
    $sql = "select id_cat, id, nombre, fechafin from items";
    $rs= $cn->query($sql);
    while ($fila=$rs->fetch_object()){     
        if(comprobarFechaVencida($fila->fechafin)){
            $itemsVencidos[]=$fila;
        }
    }
    return $itemsVencidos;
}

//Funcion que a traves de ID_CAT saca la CATEGORIA
function sacarCategoria($cn, $id_cat){
    $sql = "select categoria from categorias where id=$id_cat";
    $rs= $cn->query($sql);
    $resul = $rs->fetch_object();
    return $resul->categoria;
}

//Funcion que pone el FORMATO deseado a una FECHA
function formatearFecha($f){
    $resul = date("d-M-y i:s", strtotime($f));
    return $resul;
}

//Funcion que sasca datos EXTRA de un ITEM
function sacarExtra($cn, $id_item){
    $sql = "select id_user, preciopartida, descripcion from items where id=$id_item";
    $rs = $cn->query($sql);
    $resul = $rs->fetch_object();
    $resul->id_user = sacarNombreUsu($cn, $resul->id_user);
    return $resul;
}

//Funcion que devuelve el NOMBRE de un USUARIO a traves de su ID
function sacarNombreUsu($cn, $id){
    $sql = "select nombre from usuarios where id=$id";
    $rs= $cn->query($sql);
    return $rs->fetch_object()->nombre;
}

//Funcion que devuelve un array de items VIGENTES
function sacarItemsVigentes($cn){
    $itemsVigentes = array();
    $sql = "select id, nombre, fechafin from items";
    $rs= $cn->query($sql);
    while ($fila=$rs->fetch_object()){     
        if(!comprobarFechaVencida($fila->fechafin)){
            $itemsVigentes[]=$fila;
        }
    }
    return $itemsVigentes;
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
        return "Sin pujas";
    }
    $sql = "select max(cantidad) max from pujas where id_item='$id_item'";
    $rs = $cn->query($sql);
    $max = $rs->fetch_object();
    $row_cnt = $rs->num_rows;
    return $max->max;
}

//Funcion que devuelve el TIEMPO RESTANTE para una FECHA
function cuantoqueda($cn, $fecha){
    $tactual = time();
    $meses = intval(($tactual-$fecha)/(60*60*24*30));
    $restoMes = ($tactual-$fecha)%(60*60*24*30);
    $dias = intval($restoMes/(60*60*24));
    if($meses>1){
        if($dias>1){
            $resul = $meses . " meses " . $dias . " dias";
        }else{
            $resul = $meses . " meses " . $dias . " dia";
        }
    }else{
        if($meses == 0){
            if($dias>1){
                $resul = $dias . " dias";
            }else{
                $resul = $dias . " dia";
            }
        } else {
            if($dias>1){
            $resul = $meses . " mes" . $dias . " dias";
            }else{
                $resul = $meses . " mes" . $dias . " dia";
            }
        }
    }
    return $resul;
}

function cargarLista($ListaPujasFicticias){
    if(isset($_SESSION['pujas'])){
        $pujasSesion = $_SESSION['pujas'];
        print_r($pujasSesion);
        foreach ($pujasSesion as $pujaSesion) {
            echo $pujaSesion;
            $ListaPujasFicticias .= "<li>$pujaSesion</li>";
        }
    }
    return $ListaPujasFicticias;
}

function guardarEnLaSesion($cn, $cantidad, $nombre, $id_item){
    $pujaMasAlta = pujaMasAlta($cn, $id_item);
    if(intval($cantidad)>intval($pujaMasAlta)){
        $pujaSesion = "<li>$nombre, $cantidad <input type='checkbox' name='elegidos' value='$nombre,$cantidad,$id_item'></li>";
        $_SESSION['pujas'][$nombre] = $pujaSesion;
        unset($_POST["submit_$nombre"]);
    }
}

function grabarpujas($elegidos){
    foreach ($elegidos as $elegido) {
        $item = explode(",", $elegido);
        //$sql = "insert into pujas (id_item, it_user, cantidad) values $item[2],";
    }
}