<?php
include 'header.php';
require 'enviarEmail.php';

if(!isset($_SESSION['username']) || $_SESSION['username']!='admin'){
    header("Location: index.php");
}

$_SESSION['urlanterior'] = $_SERVER['PHP_SELF'];


if(isset($_POST['submitAniadir'])){
    if(isset($_POST['anunciante'])){
        if(isset($_POST['tipo'])){
            if($_POST['tipo']=="email"){
                if(!isset($_SESSION['emails'])){
                    $_SESSION['emails'] = array();
                }
                $_SESSION['emails'][$_POST['anunciante']][] = $_POST['itemId'];
            }
            if($_POST['tipo']=="web"){
                if(!isset($_SESSION['webs'])){
                    $_SESSION['webs'] = array();
                }
                $_SESSION['webs'][$_POST['anunciante']][] = $_POST['itemId'];
            }
        }
    }
}

if(isset($_POST['submitEnviarPubli'])){
    if(isset($_SESSION['emails'])){
        foreach ($_SESSION['emails'] as $email => $idItems) {
            foreach ($idItems as $itemId) {
                $enlace = RUTA."itemdetalles.php?item=".$itemId;
                $itemNombre = getItemNombre($link, $itemId);
                $asunto = "La subasta del item $itemNombre esta a punto de terminar";
                //$cuerpo = "Le queremos comunicar que la subasta del item $itemNombre esta a punto de terminar. Si esta interesado, le recomendamos <a href='$enlace'>pujar</a>. Un saludo.";
                $cuerpo = "<p><a href='$enlace'>pujar</a></p>";
                enviarMail($email, "Estimado cliente de SubastasDW2", $asunto, $cuerpo);
            }
            
        }
        unset($_SESSION['emails']);
    }
    if(isset($_SESSION['webs'])){
        foreach ($_SESSION['webs'] as $web => $idItems) {
            foreach ($idItems as $itemId) {
                $f = fopen("anunciantesWeb.txt", "a");
                $texto = $web."\t".getDescripcionItem($link, $itemId)."\n";
                fputs($f, $texto);
            }
        }
        unset($_SESSION['webs']);
    }
}

$items = getItems3dias($link);

echo "<table>";
    echo "<tr><th></th><th>ITEM</th><th>VENCE EN</th><th>ANUNCIANTE</th><th>TIPO</th></tr>";
    foreach ($items as $item) {
        $t = (int)(abs(strtotime($item['fechafin'])-time())/60/60);
        echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
            echo "<tr>";
                echo "<td>".$item['nombre']."</td>";
                echo "<td>".$t." horas</td>";
                echo "<td><input type='text' name='anunciante'></td>";
                echo "<td><input type='radio' name='tipo' value='email'> Email <input type='radio' name='tipo' value='web'> Web</td>";
                echo "<td><input type='submit' name='submitAniadir' value='Añadir'></td>";
            echo "</tr>";
            echo "<input type='hidden' name='itemId' value='".$item['id']."'>";
        echo "</form>";
    }
    
echo "</table>";
?>
<form method='POST' action='<?php echo $_SERVER['PHP_SELF'] ?>'>
    <input type="submit" name="submitEnviarPubli" value="ENVIAR ANUNCIOS">
</form>
<?php
include 'footer.php';
?>
