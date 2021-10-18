<?php function getCategorias($link){
    $categorias = array();
    $sql = "select id, categoria from categorias";
    $result = mysqli_query($link, $sql);
    while ($fila = mysqli_fetch_assoc($result)){
        $categorias[] = $fila;
    }
    return $categorias;
}

function getItems($link){
    $items = array();
    $sql = "select id, id_cat, id_user, nombre, preciopartida, descripcion, fechafin from items";
    $result = mysqli_query($link, $sql);
    while ($fila = mysqli_fetch_assoc($result)){
        $items[] = $fila;
    }
    return $items;
}

function getPujas($link, $id_item){
    $pujas = array();
    $sql = "select pujas.id, pujas.cantidad, pujas.fecha, usuarios.username 
            from pujas, usuarios where id_item = $id_item 
            AND usuarios.id = pujas.id_user 
            ORDER BY pujas.cantidad DESC";
    $result = mysqli_query($link, $sql);
    while ($fila = mysqli_fetch_assoc($result)){
        $pujas[] = $fila;
    }
    return $pujas;
}

function getImagenesItem($link, $id_item){
    $imagenes = array();
    $sql = "select id, id_item, imagen from imagenes where id_item = $id_item";
    $result = mysqli_query($link, $sql);
    while ($fila = mysqli_fetch_assoc($result)){
        $imagenes[] = $fila;
    }
    return $imagenes;
}

function comprobarUsername($link, $username){
    $sql = "select id from usuarios where username = '$username'";
    $result = mysqli_query($link, $sql);
    if($fila = mysqli_fetch_assoc($result)){
        return true;
    }
    return false;
}

function setUsuario($link, $username, $nombre, $password, $email){
    $cadena = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 16);    
    $sql = "INSERT INTO usuarios (username, nombre, password, email, cadenaverificacion)"
            . " VALUES ('$username', '$nombre', '$password', '$email', '$cadena')";
    $result = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link)>0){
        return $cadena;
    }
    return false;
}

function activarUsuario($link, $email, $cadena){
    $sql = "UPDATE usuarios SET activo = '1' WHERE cadenaverificacion = '$cadena' AND email = '$email'";
    $result = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link)>0){
        return true;
    }
    return false;
}

function comprobarUsuPas($link, $username, $password){
    $sql = "select id from usuarios where username = '$username' and password = '$password'";
    $result = mysqli_query($link, $sql);
    if($fila = mysqli_fetch_assoc($result)){
        return true;
    }
    return false;
}

function cantPujas($link, $id_item){
    $sql = "SELECT COUNT(*) as cant FROM pujas WHERE id_item = ".$id_item;
    $result = mysqli_query($link, $sql);
    $cant = mysqli_fetch_object($result)->cant;
    return $cant;
}

function getPrecioActual($link, $id_item){
    $sql = "SELECT MAX(cantidad) as precio FROM pujas WHERE id_item = ".$id_item;
    $result = mysqli_query($link, $sql);
    $cant = mysqli_fetch_object($result)->precio;
    return $cant;
}

function comprobarUsuActivo($link, $username){
    $sql = "select activo from usuarios where username = '$username'";
    $result = mysqli_query($link, $sql);
    if($fila = mysqli_fetch_assoc($result)){
        if($fila['activo']=='1'){
            return true;
        }
    }
    return false;
}

function getUid($link, $username){
    $sql = "select id from usuarios where username = '$username'";
    $result = mysqli_query($link, $sql);
    $id = mysqli_fetch_object($result)->id;
    return $id;
}

function getItem($link, $id){
    $sql = "SELECT * FROM items WHERE id=$id";
    $result = mysqli_query($link, $sql);
    $item = mysqli_fetch_assoc($result);
    return $item;
}

function cantPujasHoy($link, $id_user){
    $sql = "SELECT count(*) as cant FROM pujas WHERE fecha = CURRENT_DATE AND id_user = $id_user";
    $result = mysqli_query($link, $sql);
    $cant = mysqli_fetch_object($result)->cant;
    return $cant;
}

function setPuja($link, $id_item, $id_user, $cantidad){
    $sql = "INSERT INTO pujas (id_item, id_user, cantidad, fecha) VALUES ('$id_item', '$id_user', '$cantidad', CURRENT_DATE)";
    $result = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link)>0){
        return true;
    }
    return false;
}

function insertItem($link, $categoria, $nombre, $descripcion, $fechafin, $precio, $id_user){
    $sql = "INSERT INTO items (id_cat, id_user, nombre, preciopartida, descripcion, fechafin) "
         . "VALUES ('$categoria', '$id_user', '$nombre', '$precio', '$descripcion', '$fechafin')";
    $result = mysqli_query($link, $sql);
    if($result = false){
        return false;
    }
    $id = mysqli_insert_id($link);
    return $id;
}

function updatePrecioSalidaItem($link, $p, $id){
    $sql = "UPDATE items SET preciopartida = $p WHERE id = ".$id;
    $result = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link)>0){
        return true;
    }
    return false;
}

function updateFechaFinItem($link, $f, $id, $dh){
    if($dh == "hora"){
        $f = strtotime($f)+(60*60);
    }
    if($dh == "dia"){
        $f = strtotime($f)+(60*60*24);
    }
    $f = date('Y-m-d h:i:00',$f);
    $sql = "UPDATE items SET fechafin = '$f' WHERE id = ".$id;
    $result = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link)>0){
        return true;
    }
    return false;
}

function borrarImagen($link, $id){
    $sql = "DELETE FROM imagenes WHERE id = ".$id;
    $result = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link)>0){
        return true;
    }
    return false;
}

function insertImagen($link, $id_item, $img){
    $sql = "INSERT INTO imagenes (id_item, imagen) VALUES ('$id_item', '$img')";
    $result = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link)>0){
        return true;
    }
    return false;
}

function getImagen($link, $id){
    $sql = "SELECT imagen FROM `imagenes` WHERE id = ".$id;
    $result = mysqli_query($link, $sql);
    $src = mysqli_fetch_object($result)->imagen;
    return $src;
}

function getItemsVencidos($link){
    $sql = "SELECT * FROM items WHERE fechafin < CURRENT_DATE";
    $result = mysqli_query($link, $sql);
    $items = array();
    while ($fila = mysqli_fetch_assoc($result)){
        $items[] = $fila;
    }
    return $items;
}

function getGanadorPuja($link, $id_item){
    $sql = "SELECT usuarios.nombre
            FROM usuarios, pujas 
            WHERE pujas.id_user = usuarios.id 
            and cantidad =  
                    (SELECT MAX(cantidad)
                    FROM pujas
                    where id_item = $id_item)";
    $result = mysqli_query($link, $sql);
    return mysqli_fetch_object($result)->nombre;
}

function borrarPujas($link, $id){
    $sql = "DELETE FROM pujas WHERE id_item = ".$id;
    $result = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link)>0){
        return true;
    }
    return false;
}

function borrarItem($link, $id){
    $sql = "DELETE FROM items WHERE id = ".$id;
    $result = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link)>0){
        return true;
    }
    return false;
}

function borrarImagenItem($link, $id){
    $sql = "DELETE FROM imagenes WHERE id_item = ".$id;
    $result = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link)>0){
        return true;
    }
    return false;
}

function getItems3dias($link){
    $sql = "SELECT * FROM items WHERE fechafin BETWEEN CURRENT_DATE AND (CURRENT_DATE+ INTERVAL 3 day)";
    $result = mysqli_query($link, $sql);
    $items = array();
    while ($item = mysqli_fetch_assoc($result)){
        if(cantPujas($link, $item['id'])==0){
            $items[] = $item;
        }elseif (getPrecioActual($link, $item['id'])>($item['preciopartida']*1.1)) {
            $items[] = $item;
        }
    }
    return $items;
}

function getDescripcionItem($link, $id){
    $sql = "SELECT descripcion FROM items WHERE id = ".$id;
    $result = mysqli_query($link, $sql);
    $d = mysqli_fetch_object($result)->descripcion;
    return $d;
}

function getItemNombre($link, $id){
    $sql = "SELECT nombre FROM items WHERE id = ".$id;
    $result = mysqli_query($link, $sql);
    if($result!=false){
        $d = mysqli_fetch_object($result)->nombre;
        return $d;
    }
    return false;
    
}
