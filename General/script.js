// Menú hamburguesa: Mostrar/Ocultar
function toggleMenu() {
    const menu = document.getElementById('menu');
    const menuIcon = document.querySelector('.menu-icon');
    
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
        menuIcon.classList.remove('active'); // Cambia el estado del ícono
    } else {
        menu.style.display = 'block';
        menuIcon.classList.add('active'); // Cambia el estado del ícono
    }
}

// Referencias del buscador
const searchBtn = document.getElementById('search-btn');
const searchContainer = document.getElementById('search-container');
const searchInput = document.getElementById('search-input');
const cancelBtn = document.getElementById('cancel-btn');

// Mostrar/Ocultar buscador
searchBtn.addEventListener('click', () => {
    const isSearchVisible = searchContainer.style.display === 'block';

    if (isSearchVisible) {
        // Oculta el buscador
        searchContainer.style.display = 'none';
        cancelBtn.style.display = 'none';
        searchInput.value = ''; // Limpia el campo de búsqueda
    } else {
        // Muestra el buscador
        searchContainer.style.display = 'block';
        cancelBtn.style.display = 'inline-block';
        searchInput.focus(); // Enfoca automáticamente en el campo
    }
});

// Cancelar búsqueda
cancelBtn.addEventListener('click', () => {
    searchContainer.style.display = 'none'; // Oculta el contenedor de búsqueda
    cancelBtn.style.display = 'none';
    searchInput.value = ''; // Limpia el contenido del campo
});

// Modo móvil: Ajustar comportamiento
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        // Resetea la vista al cambiar a pantallas grandes
        searchContainer.style.display = 'none';
        cancelBtn.style.display = 'none';
        const mobileSearchBtn = document.getElementById('mobile-search-btn');
        if (mobileSearchBtn) {
            mobileSearchBtn.style.display = 'none';
        }
    }
});
// Seleccionar elementos
const avatarInput = document.getElementById('avatar-upload');
const avatarImg = document.getElementById('avatar-img');

// Manejar cambio de imagen
avatarInput.addEventListener('change', (event) => {
    const file = event.target.files[0]; // Archivo seleccionado
    if (file) {
        const fileType = file.type;
        if (fileType === "image/png" || fileType === "image/jpeg") {
            const reader = new FileReader();
            reader.onload = function (e) {
                avatarImg.src = e.target.result; // Mostrar vista previa
            };
            reader.readAsDataURL(file);
        } else {
            alert("Por favor, selecciona un archivo .png o .jpg");
        }
    }
});

// Enviar un mensaje cuando el usuario presiona el botón "Enviar"
document.querySelector('.send-btn').addEventListener('click', function() {
    const messageInput = document.querySelector('.message-input');
    const messageText = messageInput.value;

    if (messageText.trim() !== '') {
        addMessage('Usuario', messageText); // Añadir el mensaje al chat
        messageInput.value = ''; // Limpiar el campo de texto
    }
});

// Función para agregar un mensaje al chat
function addMessage(user, text) {
    const chatBody = document.querySelector('.chat-body');
    const messageDiv = document.createElement('div');
    messageDiv.className = 'message';
    messageDiv.innerHTML = `<span class="user">${user}:</span><span class="text">${text}</span>`;
    chatBody.appendChild(messageDiv);
    chatBody.scrollTop = chatBody.scrollHeight; // Desplazar al último mensaje
}
