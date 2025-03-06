// chat.js (JavaScript separado para el sistema de chat)

// Enviar mensaje al servidor
async function sendMessage() {
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value.trim();

    if (!message) return;

    const response = await fetch('chatg.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ message })
    });

    const result = await response.json();

    if (result.status === 'success') {
        messageInput.value = '';
        loadMessages();
    } else {
        alert(result.message);
    }
}

// Cargar mensajes recientes
async function loadMessages() {
    const response = await fetch('chatg.php');
    const messages = await response.json();

    const chatBody = document.getElementById('chat-body');
    chatBody.innerHTML = '';

    messages.forEach(msg => {
        const div = document.createElement('div');
        div.className = 'message';
        div.textContent = `[${msg.created_at}] ${msg.content}`;
        chatBody.appendChild(div);
    });
}

// Actualizar mensajes periódicamente
setInterval(loadMessages, 3000);
window.onload = loadMessages;
