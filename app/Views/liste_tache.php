<!-- Lien vers la feuille de style -->
<link href="/assets/css/listTache.css" rel="stylesheet" type="text/css">

<section>
    <!-- Bandeau en haut du projet -->
    <div class="project-header d-flex justify-content-between align-items-center bg-violet p-4 rounded mb-4">
        <div>
            <h1>Projet : <?= esc($projet['titreprojet']) ?></h1>
            <p>Description : <?= esc($projet['descriptionprojet']) ?></p>
        </div>
        <button class="btn btn-share">Partager</button>
    </div>

    <h2>Liste des Tâches</h2>
    
    <?php if (!empty($taches)) : ?>
        <div class="task-columns">
            <!-- À Faire -->
            <div class="task-column a-faire">
                <h3>À Faire</h3>
                <?php foreach ($taches as $tache) : ?>
                    <?php if ($tache['statut'] === 'A Faire') : ?>
                        <div class="task-card">
                            <h4><?= esc($tache['titre']) ?></h4>
                            <p><strong>Date limite:</strong> <?= esc($tache['echeance']) ?></p>
                            <div class="task-actions">
                                <img src="/assets/img/pencil.png" alt="Modifier" class="icon"
                                     onclick="openEditModal(<?= htmlspecialchars(json_encode($tache), ENT_QUOTES, 'UTF-8') ?>)" />
                                <img src="/assets/img/remove.png" alt="Supprimer" class="icon"
                                     onclick="if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) location.href='/suppModif/<?= esc($tache['idtache']) ?>';" />
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
				<button class="btn btn-primary">Ajouter une tâche</button>
            </div>
            
            <!-- En Cours -->
            <div class="task-column en-cours">
                <h3>En Cours</h3>
                <?php foreach ($taches as $tache) : ?>
                    <?php if ($tache['statut'] === 'En cours') : ?>
                        <div class="task-card">
                            <h4><?= esc($tache['titre']) ?></h4>
                            <p><strong>Date limite:</strong> <?= esc($tache['echeance']) ?></p>
                            <div class="task-actions">
                                <img src="/assets/img/pencil.png" alt="Modifier" class="icon"
                                     onclick="openEditModal(<?= htmlspecialchars(json_encode($tache), ENT_QUOTES, 'UTF-8') ?>)" />
                                <img src="/assets/img/remove.png" alt="Supprimer" class="icon"
                                     onclick="if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) location.href='/suppModif/<?= esc($tache['idtache']) ?>';" />
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
				<button class="btn btn-primary">Ajouter une tâche</button>
            </div>
            
            <!-- Terminées -->
            <div class="task-column terminee">
                <h3>Terminées</h3>
                <?php foreach ($taches as $tache) : ?>
                    <?php if ($tache['statut'] === 'Terminée') : ?>
                        <div class="task-card">
                            <h4><?= esc($tache['titre']) ?></h4>
                            <p><strong>Date limite:</strong> <?= esc($tache['echeance']) ?></p>
                            <div class="task-actions">
                                <img src="/assets/img/pencil.png" alt="Modifier" class="icon"
                                     onclick="openEditModal(<?= htmlspecialchars(json_encode($tache), ENT_QUOTES, 'UTF-8') ?>)" />
                                <img src="/assets/img/remove.png" alt="Supprimer" class="icon"
                                     onclick="if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) location.href='/suppModif/<?= esc($tache['idtache']) ?>';" />
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
				<button class="btn btn-primary">Ajouter une tâche</button>
            </div>
        </div>
    <?php else : ?>
        <p>Aucune tâche trouvée pour ce projet.</p>
    <?php endif; ?>
</section>

<!-- Modal -->
<div id="editTaskModal" style="display: none;">
    <div class="modal-content">
        <span id="closeModal" style="cursor: pointer;">&times;</span>
        <h2>Modifier la Tâche</h2>
        <form id="editTaskForm" method="POST" action="/modifierTache">
            <input type="hidden" name="idtache" id="modalIdTache">
            <div>
                <label for="modalTitre">Titre :</label>
                <input type="text" id="modalTitre" name="titre" required>
            </div>
            <div>
                <label for="modalStatut">Statut :</label>
                <select id="modalStatut" name="statut" required>
                    <option value="En cours">En cours</option>
                    <option value="Terminée">Terminée</option>
                    <option value="A Faire">A Faire</option>
                </select>
            </div>
            <div>
                <label for="modalEcheance">Date limite :</label>
                <input type="date" id="modalEcheance" name="echeance" required>
            </div>
            <button type="submit">Enregistrer</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(tache) {
        // Remplir les champs du formulaire avec les données de la tâche
        document.getElementById('modalIdTache').value = tache.idtache;
        document.getElementById('modalTitre').value = tache.titre;
        document.getElementById('modalStatut').value = tache.statut;
        document.getElementById('modalEcheance').value = tache.echeance;

        // Afficher la popup
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
</script>
