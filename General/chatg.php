<?php
// chatg.php (Chat Futurista con integración a la base de datos usando PDO y la tabla comentarios)

// Incluir archivo de conexión a la base de datos
include '../Auth/db_connection.php';

// Manejo de API
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['message']) && !empty(trim($_POST['message']))) {
        // Guardar mensaje en la base de datos
        $message = trim($_POST['message']);

        $stmt = $pdo->prepare("INSERT INTO comentarios (descripcion, fecha_creacion) VALUES (:descripcion, CURDATE())");
        $stmt->bindParam(':descripcion', $message, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se pudo guardar el mensaje."]);
        }
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener mensajes recientes
    $stmt = $pdo->query("SELECT descripcion AS content, fecha_creacion AS created_at FROM comentarios ORDER BY fecha_creacion DESC LIMIT 20");
    $messages = $stmt->fetchAll();

    echo json_encode($messages);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Futurista</title>
    <link rel="stylesheet" href="styles.css">
    <script src="chat.js"></script>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <span>Últimos Mensajes Enviados</span>
        </div>
        <div class="chat-body" id="chat-body">
            <!-- Los mensajes se cargarán aquí -->
        </div>
        <div class="chat-footer">
            <input type="text" id="message-input" placeholder="Escribe tu mensaje...">
            <button onclick="sendMessage()">Enviar</button>
        </div>
    </div>
</body>
</html>