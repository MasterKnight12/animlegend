<?php
// Configuración de encabezados y conexión a la base de datos
header('Content-Type: application/json');
require 'db_connection.php'; // Torero

// Leer los datos enviados desde el cliente
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['email'], $input['username'], $input['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos.']);
    exit;
}

// Asignar valores a variables
$email = trim($input['email']);
$username = trim($input['username']);
$password = trim($input['password']);

// Validar datos en el servidor
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Correo inválido.']);
    exit;
}

if (strlen($username) < 3 || strlen($username) > 15) {
    echo json_encode(['status' => 'error', 'message' => 'El nombre de usuario debe tener entre 3 y 15 caracteres.']);
    exit;
}

if (strlen($password) < 8 || strlen($password) > 24) {
    echo json_encode(['status' => 'error', 'message' => 'La contraseña debe tener entre 8 y 24 caracteres.']);
    exit;
}

try {
    // Verificar si el correo ya está registrado
    $stmt = $pdo->prepare('SELECT correo FROM Usuarios WHERE correo = ?');
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'error', 'message' => 'El correo ya está registrado.']);
        exit;
    }

    // Hashear la contraseña
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insertar el nuevo usuario en la base de datos
    $stmt = $pdo->prepare('INSERT INTO Usuarios (nombre_usuario, correo, contraseña) VALUES (?, ?, ?)');
    if ($stmt->execute([$username, $email, $hashedPassword])) {
        echo json_encode(['status' => 'success', 'message' => 'Registro exitoso.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar el usuario.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>
