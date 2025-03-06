<?php
// Inicia la sesión
session_start();

// Incluye la conexión a la base de datos
require_once '../Auth/db_connection.php';

// Verifica si el usuario no está autenticado
if (!isset($_SESSION['usuario_id'])) {
    // Redirige al formulario de inicio de sesión
    header('Location: ../IniciarSesion/inicio.html');
    exit();
}

// Si el usuario está autenticado, puedes cargar el contenido del sitio
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
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

<main>
    <section id="Anuncios">
        <h2>Noticias</h2>
    </section>
    <section id="para-ti">
        <h2>Para ti</h2>
    </section>
    <section id="recomendaciones">
        <h2>Recomendaciones</h2>
    </section>
    <section id="ultimos-capitulos">
        <h2>Últimos Capítulos</h2>
    </section>
    <section id="capitulo-mas-votado">
        <h2>Capítulo Más Votado</h2>
    </section>
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
</footer>

<!-- Scripts -->
<script src="script.js"></script>
<script src="ajustes.js"></script>
</body>
</html>
