
document.getElementById('forgotPasswordForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const email = document.getElementById('email').value.trim();
    if (!email) {
        alert('Por favor, ingresa tu correo electrónico.');
        return;
    }

    try {
        const response = await fetch('../Auth/forgot_password.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email }),
        });

        const result = await response.json();

        if (result.status === 'success') {
            alert('Se ha enviado un enlace de recuperación a tu correo.');
        } else {
            alert(`¡Error! ${result.message}`);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Ocurrió un error. Intenta nuevamente.');
    }
});
