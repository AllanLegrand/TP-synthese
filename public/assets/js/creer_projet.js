// Fonction pour ouvrir la fenêtre modale
function openModal() {
    document.getElementById('popupModal').style.display = 'block';
}

// Fonction pour fermer la fenêtre modale
function closeModal() {
    document.getElementById('popupModal').style.display = 'none';
}

// Si l'utilisateur clique en dehors de la fenêtre modale, fermer celle-ci
window.onclick = function(event) {
    if (event.target == document.getElementById('popupModal')) {
        closeModal();
    }
}
