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
    return "";
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

//funcion que devuelve una CADENA alfanumerica ALEATORIA
function generarStringAleatorio() {
    $length = 16;
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($caracteres);
    $resul = '';
    for ($i = 0; $i < $length; $i++) {
        $resul .= $caracteres[rand(0, $charactersLength - 1)];
    }
    return $resul;
}

//INSERTAR USUARIO en la tabla Inactivo
function insertarUsuario($cn, $usu, $ps, $email){
    $str = generarStringAleatorio();
    $sql = "insert into usuarios (username, password, email, cadenaverificacion, activo) values ('$usu', '$ps', '$email', '$str', 0);";
    $rs = $cn->query($sql);
    if($cn->affected_rows==0){
        return false;
    }else{
        return $str;
    }
}

//ENVIA el CORREO de VERIFICACION
function enviarCorreo($str, $email, $usu){
    // put your code here
        session_start();
        require_once './PHPmailer/class.phpmailer.php';
        require_once './PHPmailer/class.smtp.php';
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth=true;
        
        $mail->Host="smtp.gmail.com";
        $mail->Port=587;
        $mail->SMTPSecure='tls';
        $mail->Username = "dwes.ciudadjardin@gmail.com";
        $mail->Password = "dwes2019";
        
        $mail->From = "dwes.ciudadjardin@gmail.com";
        $mail->FromName = "app web";
        $mail->AddAddress("$email", "$usu");
        $mail->Subject="REGISTRO EN SUBASTAS CIUDAD JARDIN";
        
        $texto="<a href='http://localhost/Subastas/verificacion.php/?cadena=$str'>Pinche aquí para verificar este correo</a>"
                . "<br> Si NO conoce SUBASTAS CIUDAD JARDIN no haga nada, ha sido un error."
                . "Si le interesa saber mas sobre nosotrs, pinche <a href='http://localhost/Subastas/index.php'>aquí</a>";
        
        $mail->IsHTML(true);
        $mail->MsgHTML($texto);
        
        if(!$mail->Send()) {
            false;
        } else {
            true;
        }
}

//Funcion a la que se le pasa la CADENA DE VERIFICAION de un usuaio y pone su valor a ACTIVO
function verificarUsuario($cn, $str){
    $sql = "update usuarios set activo = 1 where cadenaverificacion = '$str'";
    $rs = $cn->query($sql);
    if($cn->affected_rows==0){
        return false;
    }else{
        return true;
    }
}

//Funcion que VERIFICA los DATOS de LOGIN de un usuario
function verificarUsu($cn, $usu, $ps){
    $sql1 = "select password from usuarios where username='$usu'";
    $rs1 = $cn->query($sql1);
    //si el resulset ha salido false, es por que la condicion where no se ha cumplido, por lo que el usuario es incorrecto
    
    if($rs1->num_rows==0){
        return "usuario";
    }
    
    //Saco la clave de ese usuario y compruebo si es la que me han pasado
    $clave = $rs1->fetch_object();
    if($ps != $clave->password){
        return "clave";
    }
    
    //ahora hago otra consulta en la que saco el valor de activo, para saber sila cuenta se ha verificado o no
    $sql2 = "select activo from usuarios where username = '$usu'";
    $rs2 = $cn->query($sql2);
    $activo = $rs2->fetch_object();
    if($activo->activo == 0){
        return "verificar";
    }
    return "verificado";
}

//Funcion que mediante un nombre de USUARIo saca el ID
function sacarId($cn, $nombre){
    $sql = "select id from usuarios where username='$nombre'";
    $rs = $cn->query($sql);
    if($rs->num_rows==0){
        return false;
    }
    $id = $rs->fetch_object();
    return $id->id;
}

//Funcion que devuelve la INFORMACION DETALLADA DE UN ITEM a traves de su id
function sacarInfo($cn, $id){
    $sql = "select nombre, descripcion, fechafin from items where id='$id'";
    $rs = $cn->query($sql);
    if($rs->num_rows==0){
        return false;
    }
    $item = $rs->fetch_object();
    return $item;
}

//funcion que mediante el ID de un item, saca TODAS las IMAGENES
function sacarImagenes($cn, $id_item){
    $sql = "select imagen from imagenes where id_item='$id_item'";
    $rs = $cn->query($sql);
    $imagenes = array();
    while($fila = mysqli_fetch_object($rs)){
        $imagenes[] = $fila->imagen;
    }
    return $imagenes;
}

//funcion que INTRODUCE una PUJA
function introducirPuja($cn, $id_item, $id_user, $cantidad){
    $sql = "insert into pujas (id_item, id_user, cantidad) values ($id_item, $id_user, $cantidad)";
    $rs = $cn->query($sql);
    if($cn->affected_rows==0){
        return false;
    }
    return true;
}

//Funcion que mediante un ID de un ITEM saca TODAS las PUJAS
function sacarPujasID($cn, $id_item){
    $sql = "select id_user, cantidad from pujas where id_item=$id_item";
    $rs = $cn->query($sql);
    while($fila = mysqli_fetch_object($rs)){
         $resul[] = $fila;
    }
    return $resul;
}

//Funcion que mediante el ID de un USUARIO saca el USERNAME
function sacarUsername($cn,$id_user){
    $sql = "select username from usuarios where id=$id_user";
    $rs = $cn->query($sql);
    if($rs->num_rows==0){
        return false;
    }     
    $resul = $rs->fetch_object();
    return $resul->username;
}

//Funcion que AÑADE un ITEM
function aniadirItem($cn, $id_cat, $id_user, $nombre, $preciopartida, $descripcion, $fechafin){
    /*
     * Cláusula OUTPUT
        Devuelve las filas insertadas como parte de la operación de inserción. Los resultados se pueden devolver a la aplicación de procesamiento o insertarse en una tabla o variable de tabla para su nuevo procesamiento.
     */
    $sql = "insert into items (id_cat, id_user, nombre, preciopartida, descripcion, fechafin) values ($id_cat, $id_user, '$nombre', $preciopartida, '$descripcion', '$fechafin')";
    $rs = $cn->query($sql);
    if($cn->affected_rows<=0){
        echo "-------------------------------------------------------EL INSERT INTO NO HA FUNCIONADO. sql: $sql------------------------------------------------------<br>";
        return false;
    }
    echo "-------------------------------------------------------EL INSERT INTO SI HA FUNCIONADO: $cn->affected_rows------------------------------------------------------<br>";
    $sql = "select id from items where id_cat = $id_cat and id_user = $id_user and nombre = '$nombre' and preciopartida = $preciopartida and descripcion = '$descripcion' and fechafin = '$fechafin'";
    $rs = $cn->query($sql);
    if($rs->num_rows==0){
        echo "-------------------------------------------------------NO HA SELECCIONADO NADA------------------------------------------------------<br>";
        echo "-------------------------------------------------------$sql------------------------------------------------------";
        return  false;
    }
    $resul = $rs->fetch_object();
    return $resul->id;
}

