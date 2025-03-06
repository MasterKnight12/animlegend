<?php
// Configuración de encabezados y conexión a la base de datos
header('Content-Type: application/json');
session_start(); // Inicia la sesión
require 'db_connection.php'; // Conexión a la base de datos

// Leer los datos enviados desde el cliente
$input = json_decode(file_get_contents('php://input'), true);

// Verificar que se enviaron todos los datos
if (!isset($input['email'], $input['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos.']);
    exit;
}

// Asignar valores a variables
$email = trim($input['email']);
$password = trim($input['password']);

// Validar formato de correo
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Correo inválido.']);
    exit;
}

if (strlen($password) < 8 || strlen($password) > 24) {
    echo json_encode(['status' => 'error', 'message' => 'La contraseña debe tener entre 8 y 24 caracteres.']);
    exit;
}

try {
    // Buscar al usuario en la base de datos por su correo
    $stmt = $pdo->prepare('SELECT usuario_id, nombre_usuario, contraseña FROM usuarios WHERE correo = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verificar si el usuario existe
    if (!$user) {
        echo json_encode(['status' => 'error', 'message' => 'Correo no registrado.']);
        exit;
    }

    // Verificar la contraseña
    if (!password_verify($password, $user['contraseña'])) {
        echo json_encode(['status' => 'error', 'message' => 'Contraseña incorrecta.']);
        exit;
    }

    // Configurar la sesión del usuario
    $_SESSION['usuario_id'] = $user['usuario_id'];
    $_SESSION['nombre_usuario'] = $user['nombre_usuario'];

    // Respuesta exitosa
    echo json_encode([
        'status' => 'success',
        'message' => 'Inicio de sesión exitoso.',
        'user' => [
            'id' => $user['usuario_id'],
            'name' => $user['nombre_usuario'],
        ],
    ]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    exit;
}
?>
