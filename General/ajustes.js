document.getElementById('guardar-ajustes').addEventListener('click', () => {
    // Esto simula el guardado de datos
    alert('Cambios guardados con éxito.');

    // Redirige al perfil
    window.location.href = 'perfil.php';
});

// Opcional: Cambiar temas dinámicamente No se si me dara tiempo
document.getElementById('tema').addEventListener('change', (e) => {
    const temaSeleccionado = e.target.value;
    if (temaSeleccionado === 'dark') {
        document.body.style.backgroundColor = '#121212';
        document.body.style.color = 'white';
    } else {
        document.body.style.backgroundColor = 'white';
        document.body.style.color = 'black';
    }
});
