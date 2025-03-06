// Asociar el evento 'submit' al formulario de registro
document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault(); // Evita la recarga de la página

    // Obtener valores de los campos
    const email = document.getElementById('email').value.trim();
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    // Validaciones básicas en el cliente
    if (!email || !username || !password) {
        alert('Por favor, completa todos los campos.');
        return;
    }

    if (!validateEmail(email)) {
        alert('Por favor, introduce un correo electrónico válido.');
        return;
    }

    if (username.length < 3 || username.length > 15) {
        alert('El nombre de usuario debe tener entre 3 y 15 caracteres.');
        return;
    }

    if (password.length < 8 || password.length > 24) {
        alert('La contraseña debe tener entre 8 y 24 caracteres.');
        return;
    }

    try {
        // Mostrar en consola los datos enviados para depuración
        console.log('Datos enviados:', { email, username, password });

        // Enviar la solicitud POST al servidor
        const response = await fetch('../Auth/register.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, username, password }),
        });

        // Leer la respuesta del servidor
        const textResponse = await response.text(); // Leer como texto para evitar errores JSON
        console.log('Respuesta del servidor:', textResponse);

        const result = JSON.parse(textResponse); // Convertir respuesta a JSON

        if (!response.ok || result.status !== 'success') {
            throw new Error(result.message || 'Error en la comunicación con el servidor.');
        }

        alert(result.message); // Mostrar mensaje de éxito
        window.location.href = '../General/index.php'; // Redirigir tras el registro exitoso
    } catch (error) {
        console.error('Error en el registro:', error);
        alert('Ocurrió un error al intentar registrar el usuario. Por favor, inténtalo de nuevo más tarde.');
    }
});

// Validar formato de correo electrónico
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Cambiar entre estilos al hacer clic en el botón con id 'changeStyleBtn'
document.getElementById('changeStyleBtn').addEventListener('click', () => {
    const body = document.body;
    body.classList.toggle('rosa');
    body.classList.toggle('azul');
});
