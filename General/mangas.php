<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Biblioteca de Animes</title>
</head>
<body>
<header>
    <div class="menu-icon" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div id="logo-container">
        <img id="logo" src="Logo.png" alt="Logo">
    </div>
    <div class="d-flex align-items-center">
        <button class="search-btn" id="search-btn">🔍</button>
    </div>
</header>

<!-- Contenedor del buscador -->
<div id="search-container" class="search-container">
    <input type="text" id="search-input" placeholder="Buscar por género...">
    <button id="cancel-btn">Cancelar</button>
</div>

<!-- Contenido General -->
<main>
    <h1>Biblioteca de Animes</h1>
<!-- Contenedor de Géneros -->
<div class="genres-container">
    <ul id="genres-list">
        <li>
            <button class="genre-btn" data-genre="romance">Romance</button>
            <div class="genre-status" id="romance-status-container" style="display: none;">
                <label for="romance-status">Estado:</label>
                <select id="romance-status">
                    <option value="finalizado">Finalizado</option>
                    <option value="en-curso">En curso</option>
                    <option value="cancelado">Cancelado</option>
                </select>
                <button class="filter-btn" data-genre="romance">Filtrar</button>
            </div>
        </li>
        <li>
            <button class="genre-btn" data-genre="accion">Acción</button>
            <div class="genre-status" id="accion-status-container" style="display: none;">
                <label for="accion-status">Estado:</label>
                <select id="accion-status">
                    <option value="finalizado">Finalizado</option>
                    <option value="en-curso">En curso</option>
                    <option value="cancelado">Cancelado</option>
                </select>
                <button class="filter-btn" data-genre="accion">Filtrar</button>
            </div>
        </li>
        <!-- Añadir más géneros si es necesario -->
    </ul>
</div>

<!-- Contenedor de Resultados -->
<div class="results-container">
    <h2>Resultados</h2>
    <div id="results" class="results-grid">
        <!-- Aquí aparecerán los resultados filtrados -->
    </div>
</div>


</main>

<nav id="menu">
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="generos.php">Géneros</a></li>
        <li><a href="ajustes.php">Ajustes</a></li>
        <li><a href="mangas.php">Bibloteca</a></li>
        <li><a href="reglas.php">Reglas</a></li>
    </ul>
</nav>

<footer class="footer">
    <div class="container text-center">
        <p class="sobre-nosotros">
            <strong>Sobre nosotros:</strong> Somos una comunidad apasionada por el anime y la cultura otaku.
        </p>
        <p>&copy; 2024 AnimLegend. Todos los derechos reservados.</p>
    </div>
</footer>

<script src="script.js"></script>
<script src="biblioteca.js"></script>
</body>
</html>
