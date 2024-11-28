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
