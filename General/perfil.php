<?php
// Inicia la sesión
session_start();

// Incluye la conexión a la base de datos
require_once '../Auth/db_connection.php';

// Verifica si el usuario no está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../IniciarSesion/inicio.html');
    exit();
}

// Obtiene los datos del usuario desde la base de datos
$usuario_id = $_SESSION['usuario_id'];

try {
    // Ajustamos para obtener la biografía, imagen de perfil, etc.
    $stmt = $pdo->prepare("SELECT nombre_usuario, biografia, imagen_perfil, seguidores, rol, es_legend, fecha_registro FROM usuarios WHERE usuario_id = ?");
    $stmt->execute([$usuario_id]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "Error: Usuario no encontrado.";
        exit();
    }
} catch (PDOException $e) {
    die("Error al obtener los datos del usuario: " . $e->getMessage());
}

// Maneja la actualización de la biografía
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['biografia'])) {
    try {
        // Escapamos los datos para prevenir ataques XSS
        $nueva_biografia = htmlspecialchars($_POST['biografia'], ENT_QUOTES, 'UTF-8');
        $stmt_update = $pdo->prepare("UPDATE usuarios SET biografia = ? WHERE usuario_id = ?");
        $stmt_update->execute([$nueva_biografia, $usuario_id]);

        // Actualiza la biografía localmente
        $user['biografia'] = $nueva_biografia;
        $mensaje_exito = "Biografía actualizada con éxito.";
    } catch (PDOException $e) {
        $mensaje_error = "Error al actualizar la biografía: " . $e->getMessage();
    }
}

// Maneja la actualización de la imagen de perfil
if (isset($_FILES['imagen_perfil']) && $_FILES['imagen_perfil']['error'] == 0) {
    $imagen = $_FILES['imagen_perfil'];

    // Verifica que el archivo sea una imagen
    $imagen_permitida = ['image/jpeg', 'image/png'];
    if (in_array($imagen['type'], $imagen_permitida)) {
        // Lee el contenido de la imagen
        $imagen_contenido = file_get_contents($imagen['tmp_name']);

        // Prepara la consulta para actualizar la imagen en la base de datos
        $stmt_update_imagen = $pdo->prepare("UPDATE usuarios SET imagen_perfil = ? WHERE usuario_id = ?");
        $stmt_update_imagen->execute([$imagen_contenido, $usuario_id]);

        // Actualiza la imagen de perfil localmente (solo para mostrar)
        $user['imagen_perfil'] = 'data:' . $imagen['type'] . ';base64,' . base64_encode($imagen_contenido);
        $mensaje_imagen_exito = "Imagen de perfil actualizada con éxito.";
    } else {
        $mensaje_imagen_error = "Solo se permiten imágenes en formato JPEG o PNG.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
         <!-- Menú hamburguesa -->
    <div class="menu-icon" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div id="logo-container">
        <div class="menu-icon"></div>
        <img id="logo" src="Logo.png" alt="Logo">
    </div>

    <!-- Botones de perfil y búsqueda -->
    <div class="d-flex align-items-center">
        <a href="perfil.php">
            <button class="profile-btn" id="profile-btn">👤</button>
        </a>
        <button class="search-btn" id="search-btn">🔎</button>
    </div>
</header>

<nav id="menu">
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="chatg.php">Chat Global</a></li>
        <li><a href="ajustes.php">Ajustes</a></li>
        <li><a href="mangas.php">Bibloteca</a></li>
        <li><a href="reglas.php">Reglas</a></li>
    </ul>
</nav>

<!-- Contenedor de búsqueda -->
<div class="search-container" id="search-container">
    <input type="text" id="search-input" placeholder="Buscar...">
    <button id="cancel-btn">Cancelar</button>
</div>
    </header>
    <main class="perfil-container">
        <h1>Perfil de <?php echo htmlspecialchars($user['nombre_usuario']); ?></h1>
        
        <!-- Mostrar imagen de perfil -->
        <div class="perfil-avatar">
            <?php if (isset($user['imagen_perfil']) && !empty($user['imagen_perfil'])): ?>
                <img class="avatar-img" src="data:image/jpeg;base64,<?php echo base64_encode($user['imagen_perfil']); ?>" alt="Imagen de perfil">
            <?php else: ?>
                <img class="avatar-img" src="default.png" alt="Imagen de perfil">
            <?php endif; ?>
        </div>

        <!-- Formulario para cambiar la imagen de perfil -->
        <form action="perfil.php" method="POST" enctype="multipart/form-data">
            <label class="custom-file-upload" for="imagen_perfil">Seleccionar Imagen</label>
            <input type="file" name="imagen_perfil" id="imagen_perfil" accept="image/jpeg, image/png">
            <button type="submit">Actualizar Imagen</button>
        </form>

        <!-- Mensajes de éxito o error al actualizar la imagen -->
        <?php if (isset($mensaje_imagen_exito)) : ?>
            <p class="mensaje-exito"><?php echo $mensaje_imagen_exito; ?></p>
        <?php elseif (isset($mensaje_imagen_error)) : ?>
            <p class="mensaje-error"><?php echo $mensaje_imagen_error; ?></p>
        <?php endif; ?>

        <!-- Biografía -->
        <p><strong>Biografía:</strong></p>
        <form id="biografia-form" method="POST">
            <textarea name="biografia" id="biografia" rows="4" cols="50"><?php echo htmlspecialchars($user['biografia']); ?></textarea>
            <br>
            <button class="biografia-btn" type="submit">Actualizar Biografía</button>
        </form>

        <!-- Mensajes de éxito o error al actualizar la biografía -->
        <?php if (isset($mensaje_exito)) : ?>
            <p class="mensaje-exito"><?php echo $mensaje_exito; ?></p>
        <?php elseif (isset($mensaje_error)) : ?>
            <p class="mensaje-error"><?php echo $mensaje_error; ?></p>
        <?php endif; ?>

        <p><strong>Número de Seguidores:</strong> <?php echo htmlspecialchars($user['seguidores']); ?></p>
        <p><strong>Rol:</strong> <?php echo htmlspecialchars($user['rol']); ?></p>
        <p><strong>Miembro Legendario:</strong> <?php echo $user['es_legend'] ? 'Sí' : 'No'; ?></p>
        <p><strong>Fecha de Registro:</strong> <?php echo htmlspecialchars($user['fecha_registro']); ?></p>
    </main>
    <footer class="footer">
    <div class="container text-center">
        <p class="sobre-nosotros">
            <strong>Sobre nosotros:</strong> Somos una comunidad apasionada por el anime y la cultura otaku. Contáctanos para más información.
        </p>
        <div class="redes-sociales">
            <a href="https://facebook.com" target="_blank" class="red-social"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com" target="_blank" class="red-social"><i class="fab fa-twitter"></i></a>
            <a href="https://instagram.com" target="_blank" class="red-social"><i class="fab fa-instagram"></i></a>
            <a href="mailto:contacto@example.com" class="red-social"><i class="fas fa-envelope"></i></a>
            <a href="https://discord.gg/nNF9DKqF" target="_blank" class="red-social"><i class="fab fa-discord"></i></a>
        </div>
        <p>&copy; 2025 Todos los derechos reservados a AnimLegend.</p>
    </div>
    <script src="script.js" defer></script>

</body>
</html>