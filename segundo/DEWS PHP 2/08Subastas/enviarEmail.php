<?php
require("class.phpmailer.php"); 
function enviarMail($email,$nombre,$asunto,$cuerpo) {
//Crear objeto Mailer (enviador de correo)               
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 

//DATOS SERVIDOR DE CORREO zoho               

    $mail->Host = "smtp.zoho.eu";
    $mail->Port = 587;               //465
    $mail->SMTPSecure = 'tls';       //ssl    
    $mail->Username = "nerea.ciudadjardin@zohomail.eu";   
    $mail->Password = "123456zoho";


//DATOS DEL MENSAJE                
    $mail->From = "nerea.ciudadjardin@zohomail.eu";
    $mail->FromName = "Web de Subastas";              
    $mail->AddAddress($email,$nombre);
    $mail->Subject = $asunto;   
    $mail->Body = $cuerpo; 
    $mail->IsHTML(true);

//ENVIO DEL MENSAJE : devuelve true/false si se ha podido/no se ha podido enviar    
    if(!$mail->Send()){
        return true;
    }else{
        return false;
    }
}