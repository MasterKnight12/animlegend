document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault(); // Evita que el formulario recargue la página

    // Obtener valores de los campos
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();

    // Verificar que los campos no estén vacíos
    if (!email || !password) {
        alert('Por favor, completa todos los campos.');
        return;
    }

    try {
        // Enviar datos al servidor
        const response = await fetch('../Auth/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password }), // Enviar correo y contraseña
        });

        // Leer la respuesta del servidor
        const result = await response.json();

        if (result.status === 'success') {
            alert('Inicio de sesión exitoso. ¡Bienvenido!');
            window.location.href = '../General/index.php'; // Redirigir al index
        } else {
            alert(`¡Error! ${result.message}`); // Mostrar mensaje de error del servidor
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Ocurrió un error. Intenta nuevamente.');
    }
});

// Cambiar el estilo entre azul y rosa
document.getElementById('changeStyleBtn').addEventListener('click', () => {
    const body = document.body;
    body.classList.toggle('rosa');
    body.classList.toggle('azul');
});
