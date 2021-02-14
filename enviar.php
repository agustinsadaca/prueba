<?php


require("PHPMailer-master/class.phpmailer.php");
require("PHPMailer-master/class.smtp.php");

// Valores enviados desde el formulario
if ( !isset($_POST["Nombre"]) ||!isset($_POST["Apellido"]) || !isset($_POST["Email"]) || !isset($_POST["Mensaje"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}





$nombre = $_POST["Nombre"];

$apellido = $_POST["Apellido"];

$email = $_POST["Email"];

$mensaje = $_POST["Mensaje"];

$destinatario = "no-reply@c2140416.ferozo.com";

$img = "https://images.unsplash.com/photo-1601445638532-3c6f6c3aa1d6?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=633&q=80";

// Datos de la cuenta de correo utilizada para enviar v�a SMTP
$smtpHost = "mail.c2140416.ferozo.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "no-reply@c2140416.ferozo.com";  // Mi cuenta de correo
$smtpClave = "OZ6YHOGx6u";  // Mi contrase�a


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 587; 
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;


$mail->From = $email; // Email desde donde env�o el correo.
$mail->FromName = $nombre;
$mail->AddAddress($destinatario); // Esta es la direcci�n a donde enviamos los datos del formulario

$mail->Subject = "Formulario desde el Sitio Web"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "
<html> 

<body> 

<h1>Recibiste un nuevo mensaje desde el formulario de contacto</h1>


<p>Informacion enviada por el usuario de la web:</p>

<p>nombre: {$nombre}</p>

<p>email: {$email}</p>

<p>mensaje: {$mensaje}</p>

</body> 

</html>

<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    echo "El correo fue enviado correctamente.";
} else {
    echo "Ocurri� un error inesperado.";
}







?>

