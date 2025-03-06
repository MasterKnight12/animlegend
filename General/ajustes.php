<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajustes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<header>
    <!-- Este es el logo y menu -->
    <div class="menu-icon" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div id="logo-container">
        <img id="logo" src="Logo.png" alt="Logo">
    </div>
    <div class="d-flex align-items-center">
        <a href="perfil.php">
            <button class="profile-btn" id="profile-btn">👤</button>
        </a>
    </div>
</header>
<nav id="menu">
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="generos.php">Géneros</a></li>
        <li><a href="ajustes.php">Ajustes</a></li>
        <li><a href="mangas.php">Bibloteca</a></li>
        <li><a href="reglas.php">Reglas</a></li>
    </ul>
</nav>
<!-- Contenido principal -->
<main>
    <section id="ajustes" class="perfil-container">
        <div class="perfil-header text-center">
            <h2>Ajustes</h2>
        </div>
        <form id="ajustes-form" class="perfil-info">
            <div class="info-box">
                <h3>Preferencias de Usuario</h3>
                <label for="notificaciones">Notificaciones</label>
                <select id="notificaciones" class="form-control">
                    <option value="on">Activar</option>
                    <option value="off">Desactivar</option>
                </select>
                <label for="tema">Tema</label>
                <select id="tema" class="form-control">
                    <option value="light">Claro</option>
                    <option value="dark">Oscuro</option>
                </select>
            </div>
            <button type="button" id="guardar-ajustes" class="btn btn-primary mt-3">Guardar Cambios</button>
        </form>
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
        <p>&copy; 2024 AnimLegend. Todos los derechos reservados.</p>
    </div>
</footer>

<script src="ajustes.js"></script>
<script src="script.js"></script>
</body>
</html>
