// Ouvrir la popup de partage
function openSharePopup() {
    document.getElementById('popupShare').style.display = 'flex';
}

// Fermer la popup de partage
function closeSharePopup() {
    document.getElementById('popupShare').style.display = 'none';
}

function openEditModal(tache) {
    // Remplir les champs du formulaire avec les données de la tâche
    document.getElementById('modalIdTache').value = tache.idtache;
    document.getElementById('modalTitre').value = tache.titre;
    document.getElementById('modalDescription').value = tache.description;
    document.getElementById('modalEcheance').value = tache.echeance;
    document.getElementById('modalPriorite').value = tache.priorite;
    document.getElementById('modalStatut').value = tache.statut;

    // Afficher le modal
    document.getElementById('editTaskModal').style.display = 'flex';
}


document.getElementById('closeModal').onclick = function () {
    document.getElementById('editTaskModal').style.display = 'none';
};

window.onclick = function (event) {
    if (event.target === document.getElementById('editTaskModal')) {
        document.getElementById('editTaskModal').style.display = 'none';
    }
};

document.getElementById('closeAddModal').onclick = function () {
    document.getElementById('addTaskModal').style.display = 'none';
};

window.onclick = function (event) {
    if (event.target === document.getElementById('addTaskModal')) {
        document.getElementById('addTaskModal').style.display = 'none';
    }
};

function openAddModal() {
    document.getElementById('addTaskModal').style.display = 'flex';
}

function makeEditable(element, field, projectId) {
    const originalContent = element.textContent.trim();

    // Replace the content with an input field
    const input = document.createElement('textarea');
    input.value = originalContent;
    input.style.width = '100%';
    input.style.boxSizing = 'border-box';
    input.style.resize = 'none'; // Prevent resizing
    input.rows = 2;
    element.textContent = ''; // Clear the content
    element.appendChild(input);
    input.focus();

    // Handle blur (when user clicks away)
    input.addEventListener('blur', () => {
        const newValue = input.value.trim(); // Get the new value

        if (newValue === originalContent) {
            // If no change, reset back to original
            element.textContent = originalContent;
            return;
        }

        // Update the project on the server
        updateProject(field, newValue, projectId, element, originalContent);
    });

    // Handle Enter key submission
    input.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent new lines in the textarea
            input.blur();
        }
    });
}

function updateProject(field, newValue, projectId, element, originalContent) {
    fetch('/updateProject', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            field: field,
            value: newValue,
            idprojet: projectId,
        }),
    })
    .then((response) => response.json())  // Convertit la réponse en JSON
    .then((data) => {
        console.log('Réponse du serveur:', data); // Vérifie la réponse du serveur
        if (data.success) {
            // Si la mise à jour est réussie
            element.textContent = newValue;
        } else {
            // Si la mise à jour échoue, on remet l'ancien contenu
            element.textContent = originalContent;
            showErrorMessage('Erreur de mise à jour du projet');
        }
    })
    .catch((error) => {
        // En cas d'erreur dans la requête
        console.error('Error:', error);
        element.textContent = originalContent;
        showErrorMessage('Erreur de mise à jour du projet');
    });
}


function showErrorMessage(message) {
    const errorElement = document.getElementById('errorMessage');
    errorElement.textContent = message;
    errorElement.style.display = 'block';

    setTimeout(() => {
        errorElement.style.display = 'none';
    }, 3000); // Hide the error message after 3 seconds
}
