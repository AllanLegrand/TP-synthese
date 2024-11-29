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
    document.getElementById('modalIdProjet').value = tache.idprojet;

    document.getElementById('modalDateCreation').innerHTML = new Intl.DateTimeFormat('fr-FR', {
        day: '2-digit',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    }).format(new Date(tache.datecreation)).replace('.', '').toLowerCase();

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

function openCommentModal(commentaires, idtache) {
    // Filtrer les commentaires selon idtache
    const filteredComments = commentaires.filter(comment => comment.idtache === idtache.toString());

    // Vérifier s'il y a des commentaires pour cette tâche
    if (filteredComments.length > 0) {
        // Utiliser le premier commentaire (ou un autre logique)
        const firstComment = filteredComments[0];

        // Convertir la date du premier commentaire
        const dateString = firstComment.datecom;
        const date = new Date(dateString);

        // Formatteur pour afficher la date au format souhaité
        const formatter = new Intl.DateTimeFormat('fr-FR', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        });

        // Formater et afficher la date
        const formattedDate = formatter.format(date).replace('.', '').toLowerCase();

        // Afficher l'id de la tâche dans le modal
        document.getElementById('idtacheCommentaire').value = firstComment.idtache;
    } else {
        // Si aucun commentaire n'est trouvé, afficher un message approprié
        document.getElementById('idtacheCommentaire').innerHTML = 'Aucune tâche associée.';
    }

    // Générer le contenu HTML pour les commentaires
    const commentContent = filteredComments.length
        ? filteredComments.map(comment => {
            const commentDate = new Date(comment.datecom);
            const formattedDate = new Intl.DateTimeFormat('fr-FR', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
            }).format(commentDate).replace('.', '').toLowerCase();

            return `
                <div id="commentaire-simple" class="commentaire-simple">
                    <p><strong>${comment.prenom} ${comment.nom}</strong> <small> ${formattedDate}</small></p>
                    <p>${comment.contenu}</p>
                </div>
            `;
        }).join('')
        : '<p>Aucun commentaire pour cette tâche.</p>';

    // Insérer le contenu dans le modal
    document.getElementById('commentContent').innerHTML = commentContent;

    // Afficher le modal et l'overlay
    document.getElementById('commentModal').style.display = 'block';
    document.getElementById('modalOverlay').style.display = 'block';
}


function closeCommentModal() {
    // Cacher le modal et l'overlay
    document.getElementById('commentModal').style.display = 'none';
    document.getElementById('modalOverlay').style.display = 'none';
}