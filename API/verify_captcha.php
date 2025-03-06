<?php
header('Content-Type: application/json');

// Verificar si se recibió el token
if (!isset($_POST['h-captcha-response'])) {
    echo json_encode(['success' => false, 'message' => 'No se recibió el CAPTCHA.']);
    exit;
}

$captchaResponse = $_POST['h-captcha-response'];
$secretKey = "ES_41027301e86f4ef3bcae1515ddf28975"; // Tu clave secreta proporcionada por hCaptcha
$verifyUrl = "https://hcaptcha.com/siteverify";

// Preparar los datos para enviar a hCaptcha
$data = [
    'secret' => $secretKey,
    'response' => $captchaResponse,
    'remoteip' => $_SERVER['REMOTE_ADDR'], // Captura la IP del cliente
];

// Realizar la solicitud HTTP POST a la API de verificación
$ch = curl_init($verifyUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Decodificar la respuesta de la API
$verification = json_decode($response, true);

// Comprobar el resultado de la verificación
if (isset($verification['success']) && $verification['success'] === true) {
    echo json_encode(['success' => true, 'message' => 'CAPTCHA validado exitosamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'El CAPTCHA no es válido.']);
}
?>
