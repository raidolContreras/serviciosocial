<?php
// Incluir PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendTestMail() {
    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Cambia esto al servidor SMTP que estés usando
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@unimontrer.edu.mx'; // Cambia esto a tu dirección de correo electrónico real
        $mail->Password = 'Unimo2024$'; // Cambia esto a tu contraseña de correo electrónico real
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del remitente y destinatario
        $mail->setFrom('no-reply@unimontrer.edu.mx', 'UNIMO'); // Remitente visible
        $mail->addAddress('oscarcontrerasf91@gmail.com'); // Correo de destino

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Correo de Prueba';
        $mail->Body    = '<h1>Este es un correo de prueba</h1><p>Enviado desde PHPMailer.</p>';
        $mail->AltBody = 'Este es un correo de prueba en texto plano.';
        $mail->SMTPDebug = 2;

        // Enviar el correo
        $mail->send();
        echo 'El correo ha sido enviado correctamente';
    } catch (Exception $e) {
        echo "El correo no pudo ser enviado. Error: {$mail->ErrorInfo}";
    }
}

// Llamar a la función para enviar el correo
sendTestMail();
