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

// Fonction pour afficher les résultats de la recherche
function searchProjects(query) {
    const resultsContainer = document.getElementById("searchResults");

    // Si la barre de recherche est vide, cacher les résultats
    if (query.length === 0) {
        resultsContainer.style.display = 'none';  // Masquer les résultats
        return;
    }

    // Sinon, afficher la div des résultats
    resultsContainer.style.display = 'block';  // Afficher les résultats

    // Effectuer la requête AJAX pour récupérer les résultats du serveur
    fetch(`/recherche?query=${query}`)
        .then(response => response.json())
        .then(data => {
            // Si aucun résultat n'est trouvé
            if (data.length === 0) {
                resultsContainer.innerHTML = '<div class="no-results">Aucun projet correspondant trouvé.</div>';
                return;
            }

            // Si des projets sont trouvés, créer une liste
            let resultsHtml = '';
            data.forEach(project => {
                resultsHtml += `
                    <div class="result-item" onclick="selectProject(${project.idprojet})">
                        ${project.titreprojet}
                    </div>
                `;
            });

            resultsContainer.innerHTML = resultsHtml;
        })
        .catch(error => {
            console.error('Erreur de recherche:', error);
        });
}

// Fonction pour sélectionner un projet dans la liste (à personnaliser)
function selectProject(projectId) {
    // rediriger vers la page projet avec l'ID du projet
    window.location.href = `/projets/${projectId}`;
}

