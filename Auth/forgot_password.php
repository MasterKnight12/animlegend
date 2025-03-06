<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';   // Clases de PHPMailer
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

header('Content-Type: application/json');
require 'db_connection.php';

$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'Correo no proporcionado.']);
    exit;
}

$email = trim($input['email']);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Correo inválido.']);
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT usuario_id FROM Usuarios WHERE correo = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        echo json_encode(['status' => 'error', 'message' => 'Correo no registrado.']);
        exit;
    }

    // Generar un token de recuperación
    $token = bin2hex(random_bytes(16));
    $stmt = $pdo->prepare('INSERT INTO PasswordResets (correo, token) VALUES (?, ?)');
    $stmt->execute([$email, $token]);

    // Crear el enlace de recuperación
    $reset_link = "http://localhost/Reset/reset_password.php?token=$token";

    // Configuración de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Mailgun
        $mail->isSMTP();
        $mail->Host = 'smtp.mailgun.org';  // Servidor SMTP de Mailgun
        $mail->SMTPAuth = true;
        $mail->Username = 'postmaster@sandbox836dd6bfa84e4efabfd375ac895a9f2d.mailgun.org'; // Dominio de Mailgun
        $mail->Password = 'da50916fcae8031353cc51c81d6a9036-f55d7446-1203783b';  // API Key de Mailgun
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Encriptación TLS
        $mail->Port = 587;  // Puerto SMTP

        // Configuración del correo
        $mail->setFrom('no-reply@animlegend.com', 'AnimLegend');  // Remitente
        $mail->addAddress($email);  // Destinatario
        $mail->Subject = 'Recuperación de Contraseña';
        $mail->Body    = "Hola, haz clic en el siguiente enlace para restablecer tu contraseña:\n\n$reset_link";

        // Enviar el correo
        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Enlace de recuperación enviado a tu correo.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'No se pudo enviar el correo: ' . $mail->ErrorInfo]);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    exit;
}
?>
