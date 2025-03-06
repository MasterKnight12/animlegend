// Datos de ejemplo: títulos clasificados por género y estado
const mangas = {
    romance: {
        finalizado: ["Kimi ni Todoke", "Clannad", "Toradora!"],
        enCurso: ["Fruits Basket", "Your Name"],
        cancelado: ["Midnight Eye"]
    },
    accion: {
        finalizado: ["Attack on Titan", "My Hero Academia"],
        enCurso: ["Demon Slayer", "Jujutsu Kaisen"],
        cancelado: ["Bleach: Thousand-Year Blood War"]
    },
    // Agrega más géneros con su respectivo estado
};

// Mostrar/ocultar el cuadro de selección de estado
document.querySelectorAll('.genre-btn').forEach(button => {
    button.addEventListener('click', () => {
        const genre = button.getAttribute('data-genre');
        const statusContainer = document.getElementById(`${genre}-status-container`);

        // Mostrar el cuadro de estado
        statusContainer.style.display = statusContainer.style.display === 'none' ? 'block' : 'none';
    });
});

// Filtrar mangas por género y estado
document.querySelectorAll('.filter-btn').forEach(button => {
    button.addEventListener('click', () => {
        const genre = button.getAttribute('data-genre');
        const statusSelect = document.getElementById(`${genre}-status`);
        const selectedStatus = statusSelect.value;

        // Obtener los mangas filtrados
        const filteredMangas = mangas[genre][selectedStatus.replace('-', '')];

        // Mostrar los resultados
        const resultsContainer = document.getElementById('results');
        resultsContainer.innerHTML = ''; // Limpiar resultados previos

        if (filteredMangas) {
            filteredMangas.forEach(title => {
                const mangaCard = document.createElement('div');
                mangaCard.className = 'manga-card';
                mangaCard.textContent = title;
                resultsContainer.appendChild(mangaCard);
            });
        } else {
            resultsContainer.innerHTML = '<p>No hay resultados para este filtro.</p>';
        }
    });
});
