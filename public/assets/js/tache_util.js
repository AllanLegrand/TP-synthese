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

// Fonction pour filtrer les utilisateurs
function filterUsers() {
    const searchInput = document.getElementById('popupShareUserSearch');
    const searchResults = document.getElementById('searchResultsUsers');
    const query = searchInput.value.trim();

    fetch(`/recherche-utilisateur?query=${query}`)
        .then(response => response.json())
        .then(data => {
            searchResults.innerHTML = '';

            if (data.length > 0) {
                data.forEach(user => {
                    const li = document.createElement('li');
                    li.textContent = `${user.prenom} ${user.nom} (${user.mail})`;
                    li.style.cursor = 'pointer';
                    li.onclick = () => selectUser(user);
                    searchResults.appendChild(li);
                });
                searchResults.style.display = 'block';
            } else {
                searchResults.innerHTML = '<li>Aucun utilisateur trouvé.</li>';
                searchResults.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Erreur lors de la recherche d\'utilisateurs:', error);
        });
}

function selectUser(user) {
    const searchInput = document.getElementById('popupShareUserSearch');
    const searchResults = document.getElementById('searchResultsUsers');
    
    searchInput.value = user.mail;
    document.getElementById('selectedUserId').value = user.idutil;
    console.log(user.idutil);
    searchResults.style.display = 'none';
}


function openCommentModal(commentaires, idtache) {
    // Filtrer les commentaires selon idtache
    const filteredComments = commentaires.filter(comment => comment.idtache === idtache.toString());
    const commentsPerPage = 3; // Nombre de commentaires par page
    const maxVisiblePages = 4; // Nombre maximum de numéros de pages visibles
    let currentPage = 1;

    // Fonction pour afficher une page spécifique de commentaires
    function renderComments(page) {
        const startIndex = (page - 1) * commentsPerPage;
        const endIndex = startIndex + commentsPerPage;
        const paginatedComments = filteredComments.slice(startIndex, endIndex);

        // Générer le contenu HTML pour les commentaires
        const commentContent = paginatedComments.length
            ? paginatedComments.map(comment => {
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
                        <p><strong>${comment.prenom} ${comment.nom}</strong> <small>${formattedDate}</small></p>
                        <p>${comment.contenu}</p>
                    </div>
                `;
            }).join('')
            : '<p>Aucun commentaire pour cette tâche.</p>';

        document.getElementById('commentContent').innerHTML = commentContent;

        document.getElementById('idtacheCommentaire').value = idtache;

        // Mettre à jour la pagination
        renderPagination();
    }

    // Fonction pour afficher les contrôles de pagination avec limite de numéros visibles
    function renderPagination() {
        const totalPages = Math.ceil(filteredComments.length / commentsPerPage);
        const paginationContainer = document.createElement('nav');
        paginationContainer.setAttribute('aria-label', 'Page navigation example');

        const paginationList = document.createElement('ul');
        paginationList.className = 'pagination justify-content-center custom-pagination';

        // Bouton "Précédent"
        const prevItem = document.createElement('li');
        prevItem.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
        prevItem.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage - 1})"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
  <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
</svg></a>`;
        paginationList.appendChild(prevItem);

        // Déterminer les numéros de pages à afficher
        const startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        const endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        // Si le début des pages est décalé à cause de la limite supérieure
        const adjustedStartPage = Math.max(1, endPage - maxVisiblePages + 1);

        for (let i = adjustedStartPage; i <= endPage; i++) {
            const pageItem = document.createElement('li');
            pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
            pageItem.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
            paginationList.appendChild(pageItem);
        }

        

        // Bouton "Suivant"
        const nextItem = document.createElement('li');
        nextItem.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
        nextItem.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage + 1})"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg></a>`;
        paginationList.appendChild(nextItem);

        paginationContainer.appendChild(paginationList);

        // Ajouter la pagination sous les commentaires
        document.getElementById('commentContent').appendChild(paginationContainer);
    }

    // Fonction pour changer de page
    window.changePage = function (page) {
        const totalPages = Math.ceil(filteredComments.length / commentsPerPage);
        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            renderComments(page);
        }
    };

    

    renderComments(currentPage);

    // Afficher le modal et l'overlay
    document.getElementById('commentModal').style.display = 'block';
    document.getElementById('modalOverlay').style.display = 'block';
}

function closeCommentModal() {
    document.getElementById('commentModal').style.display = 'none';
    document.getElementById('modalOverlay').style.display = 'none';
}
