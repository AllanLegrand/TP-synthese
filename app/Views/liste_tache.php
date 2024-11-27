<header>
		<h1>Projet : <?= esc($projet['titreprojet']) ?></h1>
		<p>Description : <?= esc($projet['descriptionprojet']) ?></p>
	</header>

<<<<<<< HEAD
    <section>
        <h2>Liste des Tâches</h2>
        <?php if (!empty($taches)) : ?>
            <ul>
                <?php foreach ($taches as $tache) : ?>
                    <li>
                        <strong>Tâche:</strong> <?= esc($tache['titre']) ?><br>
                        <strong>Status:</strong> <?= esc($tache['statut']) ?><br>
                        <strong>Date limite:</strong> <?= esc($tache['echeance']) ?><br>
                        <a href="<?= base_url('tache/modifier/' . esc($tache['idtache'])) ?>">Modifier</a> |
                        <a href="/suppModif/<?= esc($tache['idtache']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Aucune tâche trouvée pour ce projet.</p>
        <?php endif; ?>
    </section>
=======
	<section>
		<h2>Liste des Tâches</h2>
		<?php if (!empty($taches)) : ?>
			<ul>
			<?php foreach ($taches as $tache) : ?>
	<li>
		<strong>Tâche:</strong> <?= esc($tache['titre']) ?><br>
		<strong>Status:</strong> <?= esc($tache['statut']) ?><br>
		<strong>Date limite:</strong> <?= esc($tache['echeance']) ?><br>
		<button onclick="openEditModal(<?= htmlspecialchars(json_encode($tache), ENT_QUOTES, 'UTF-8') ?>)">Modifier</button>
		|
		<a href="/suppModif/<?= esc($tache['idtache']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">Supprimer</a>
	</li>
<?php endforeach; ?>

			</ul>
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
					<option value="Terminé">Terminé</option>
					<option value="Non commencé">Non commencé</option>
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

<style>
	#editTaskModal {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.5);
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.modal-content {
		background: white;
		padding: 20px;
		border-radius: 8px;
		width: 300px;
	}
</style>

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
>>>>>>> 9d45cfd (Ajout de la popup de modification)
