<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require "class.phpmailer.php";
        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
//DATOS DEL SERVIDOR DE CORREO
        $mail->Host = "smtp.zoho.eu";
        $mail->Port = 587;  
        $mail->SMTPSecure = "tls";
        $mail->Username = "orozcomario@zohomail.eu";
        $mail->Host = "P@ssw0rd#";
//DATOS DEL MENSAJE
        $mail->From = "orozcomario@zohomail.eu";
        $mail->FromName = "app web subastas";
        $mail->AddAddress("marioiram200@gmail.com", "El pepe");
        $mail->Subject = "Mensaje de la app web ";
//MENSAJE CON TEXTO PLANO
        $body = "Mensaje de prueba, <strong>Un saludo <3</stron>";
        $mail->Body = $body;
        
        if(!$mail->Send()){
            echo "<p>No se pudo enviar el Mensaje</p>";
        }else{
            echo "<p>Mensaje enviado</p>";
        }
        ?>
    </body>
</html>
