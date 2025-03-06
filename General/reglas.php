<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reglas</title>
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

    <!-- Contenedor de búsqueda -->
    <div class="search-container" id="search-container">
        <input type="text" id="search-input" placeholder="Buscar...">
        <button id="cancel-btn">Cancelar</button>
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

<main>
    <section class="container mt-5">
        <h1 class="text-center mb-4">Reglas de AnimLegend</h1>
        <p>Las reglas están clasificadas según la gravedad:</p>
        <ul>
            <li><span style="color: #4caf50;">🟢 Ligero:</span> Reglas básicas para mantener el orden y la convivencia.</li>
            <li><span style="color: #ffeb3b;">🟡 Intermedio:</span> Sanciones como baneo temporal o aislado.</li>
            <li><span style="color: #f44336;">🔴 Grave:</span> Infracciones graves con sanciones permanentes.</li>
        </ul>
        
        <div class="mb-5">
            <h2 class="mt-4">Reglas Básicas</h2>
            <ul class="list-group">
                <li class="list-group-item list-group-item-success">🟢 Respeto a los miembros.</li>
                <li class="list-group-item list-group-item-success">🟢 Evitar temas controversiales como política o religión.</li>
                <li class="list-group-item list-group-item-warning">🟡 Prohibida la suplantación de identidad.</li>
                <li class="list-group-item list-group-item-danger">🔴 Prohibido el uso de multicuentas.</li>
                <li class="list-group-item list-group-item-success">🟢 Uso correcto de los canales.</li>
                <li class="list-group-item list-group-item-danger">🔴 Prohibida la difusión de información privada.</li>
            </ul>
        </div>

        <div class="mb-5">
            <h2>Reglas del Creador</h2>
            <ul class="list-group">
                <li class="list-group-item list-group-item-warning">🟡 Contenido pornográfico solo en contenido de Adultos.</li>
                <li class="list-group-item list-group-item-warning">🟡 Contenido copiado de otro no esta permitido.</li>
                <li class="list-group-item list-group-item-warning">🟡 Exceso de monetización no esta permitido</li>
                <li class="list-group-item list-group-item-success">🟢 Evitar discusiones absurdas en temas controversiales.</li>
            </ul>
        </div>

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
