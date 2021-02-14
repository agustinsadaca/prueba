<?php

$_POST['Nombre'];

require("PHPMailer-master/class.phpmailer.php");
require("PHPMailer-master/class.smtp.php");

 if($_POST){
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $email = $_POST['Email'];
    $mensaje = $_POST['Mensaje'];
    $destinatario = "no-reply@c2140416.ferozo.com";

    $smtpHost = "c2140416.ferozo.com";  // Dominio alternativo brindado en el email de alta 
    $smtpUsuario = $destinatario;  // Mi cuenta de correo
    $smtpClave = "OZ6YHOGx6u";  // Mi contrase�a


    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Port = 587; 
    $mail->IsHTML(true); 
    $mail->CharSet = "utf-8";

    $mail->Host = $smtpHost; 
    $mail->Username = $smtpUsuario; 
    $mail->Password = $smtpClave;

    $mail->From = $email; // Email desde donde envio el correo.
    $mail->FromName = $nombre;
    $mail->AddAddress($destinatario);

    $mail->Subject = "Formulario desde el Sitio Web"; // Este es el titulo del email.
    $mensajeHtml = nl2br($mensaje);
    $mail->Body = "Nombre: $nombre \n<br />". // Nombre del usuario
        "Email: $email \n<br />"."Mensaje: $mensaje";    // Email del usuario
        
    $mail->AltBody = "{$mensaje} \n\n ";

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $estadoEnvio = $mail->Send(); 
    if($estadoEnvio){
        header("location:file:///C:/Users/agust/OneDrive/Programacion/Css_Html/archivos/gitpa/prueba/index.html"); 
       
    } else {
        echo "Ocurrió un error inesperado.";
        exit();
    }
}else{

    echo "no hay datos que procesar";
    exit();
}

?>
