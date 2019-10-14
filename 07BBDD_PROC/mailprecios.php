<!DOCTYPE html>
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
        // put your code here
        session_start();
        require_once 'class.phpmailer.php';
        require_once 'class.smtp.php';
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
        $mail->AddAddress("marioiram2000@gmail.com", "Mario");
        $mail->Subject="Cambios en precios";
        
        $texto="Hola, los siguientes precios han sido modificado: <br>";
        
        foreach ($_SESSION['cambios'] as $idPlato => $cambio) {
            $texto = $texto . "plato: ".$idPlato. " " . $cambio . "€ <br>";
        }
        echo $texto;
        $mail->IsHTML(true);
        $mail->MsgHTML($texto);
        
        if(!$mail->Send()) {
            echo "NO SE PUDO";
        } else {
            echo "SE PUDO";
        }
        
        
        
        ?>
    </body>
</html>
