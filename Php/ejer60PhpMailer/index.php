<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\exception;
require "./PHPMailer-6.2.0/src/Exception.php";
require "./PHPMailer-6.2.0/src/PHPMailer.php";
require "./PHPMailer-6.2.0/src/SMTP.php";

$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->SMTPDebug = 0;    // Enable verbose debug output. si deseo ver bien porque no funciona poner 2
    $mail->isSMTP();                                           // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'gwittbecker@gmail.com';                     // SMTP username
    $mail->Password   = 'gMail_1820';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable TLS encryption;

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );


    $mail->Port       = 587;
    //$mail->Port       = 465;  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('gwittbecker@gmail.com', 'Mailer');
    $mail->addAddress('gustavo.wittbecker@comunidad.ub.edu.ar', 'gustavow en ub');     // Add a recipient
    //$mail->addAddress('gustavow@bavosi.com.ar');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Aqui el asunto';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message enviado';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
}


?>





<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<style>
</style>


</head>


<body>
	Fin
</body>
</html>