<section class="container mt-5">
	<!-- Bandeau en haut du projet -->
	<div class="project-header d-flex justify-content-between align-items-center bg-violet p-4 rounded mb-4">
		<div>
			<h1>Projet : <?= esc($projet['titreprojet']) ?></h1>
			<p>Description : <?= esc($projet['descriptionprojet']) ?></p>
		</div>
		<button class="btn btn-share" onclick="openSharePopup()">Partager</button>
	</div>

	<h2>Liste des Tâches</h2>

	<?php if (!empty($taches)): ?>
		<div class="task-columns">
			<!-- À Faire -->
			<div class="task-column a-faire">
				<h3>À Faire</h3>
				<?php foreach ($taches as $tache): ?>
					<?php if ($tache['statut'] === 'A Faire'): ?>
						<div class="task-card">
							<h4><?= esc($tache['titre']) ?></h4>
							<p><strong>Date limite : </strong><?= esc($tache['echeance']) ?></p>
							<div class="task-actions">
								<img src="/assets/img/pencil.png" alt="Modifier" class="icon"
									onclick="openEditModal(<?= htmlspecialchars(json_encode($tache), ENT_QUOTES, 'UTF-8') ?>)" />
								<img src="/assets/img/remove.png" alt="Supprimer" class="icon"
									onclick="if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) location.href='/supprimerTache/<?= esc($tache['idtache']) ?>';" />
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
				<button class="btn btn-primary" onclick="openAddModal()">Ajouter une tâche</button>
			</div>

			<!-- En Cours -->
			<div class="task-column en-cours">
				<h3>En Cours</h3>
				<?php foreach ($taches as $tache): ?>
					<?php if ($tache['statut'] === 'En cours'): ?>
						<div class="task-card">
							<h4><?= esc($tache['titre']) ?></h4>
							<p><strong>Date limite : </strong><?= esc($tache['echeance']) ?></p>
							<div class="task-actions">
								<img src="/assets/img/pencil.png" alt="Modifier" class="icon"
									onclick="openEditModal(<?= htmlspecialchars(json_encode($tache), ENT_QUOTES, 'UTF-8') ?>)" />
								<img src="/assets/img/remove.png" alt="Supprimer" class="icon"
									onclick="if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) location.href='/supprimerTache/<?= esc($tache['idtache']) ?>';" />
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
				<button class="btn btn-primary" onclick="openAddModal()">Ajouter une tâche</button>
			</div>

			<!-- Terminées -->
			<div class="task-column terminee">
				<h3>Terminées</h3>
				<?php foreach ($taches as $tache): ?>
					<?php if ($tache['statut'] === 'Terminée'): ?>
						<div class="task-card">
							<h4><?= esc($tache['titre']) ?></h4>
							<p><strong>Date limite : </strong><?= esc($tache['echeance']) ?></p>
							<div class="task-actions">
								<img src="/assets/img/pencil.png" alt="Modifier" class="icon"
									onclick="openEditModal(<?= htmlspecialchars(json_encode($tache), ENT_QUOTES, 'UTF-8') ?>)" />
								<img src="/assets/img/remove.png" alt="Supprimer" class="icon"
									onclick="if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) location.href='/supprimerTache/<?= esc($tache['idtache']) ?>';" />
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
				<button class="btn btn-primary" onclick="openAddModal()">Ajouter une tâche</button>
			</div>
		</div>
	<?php else: ?>
		<div class="task-columns">
			<!-- À Faire -->
			<div class="task-column a-faire">
				<h3>À Faire</h3>
				<p>Aucune tâche trouvée pour ce projet.</p>
				<button class="btn btn-primary" onclick="openAddModal()">Ajouter une tâche</button>
			</div>

			<!-- En Cours -->
			<div class="task-column en-cours">
				<h3>En Cours</h3>
				<p>Aucune tâche trouvée pour ce projet.</p>
				<button class="btn btn-primary" onclick="openAddModal()">Ajouter une tâche</button>
			</div>

			<!-- Terminées -->
			<div class="task-column terminee">
				<h3>Terminées</h3>
				<p>Aucune tâche trouvée pour ce projet.</p>
				<button class="btn btn-primary" onclick="openAddModal()">Ajouter une tâche</button>
			</div>
		</div>
	<?php endif; ?>
</section>

<!-- Modal -->
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
				<label for="modalDescription">Description :</label>
				<textarea id="modalDescription" name="description" required></textarea>
			</div>

			<div>
				<label for="modalEcheance">Date limite :</label>
				<input type="date" id="modalEcheance" name="echeance" required>
			</div>

			<div>
				<label for="modalPriorite">Priorité :</label>
				<select id="modalPriorite" name="priorite" required>
					<option value="Faible">Faible</option>
					<option value="Moyenne">Moyenne</option>
					<option value="Forte">Forte</option>
				</select>
			</div>

			<div>
				<label for="modalStatut">Statut :</label>
				<select id="modalStatut" name="statut" required>
					<option value="A Faire">À Faire</option>
					<option value="En cours">En cours</option>
					<option value="Terminée">Terminée</option>
				</select>
			</div>

			<button type="submit">Enregistrer</button>
		</form>
	</div>
</div>


<div id="addTaskModal" style="display: none;">
	<div class="modal-content">
		<span id="closeAddModal" style="cursor: pointer;">&times;</span>
		<h2>Ajouter une Tâche</h2>
		<form id="addTaskForm" method="POST" action="/ajouterTache">
			<div>
				<label for="addTitre">Titre :</label>
				<input type="text" id="addTitre" name="titre" required>
			</div>

			<div>
				<label for="addDescription">Description :</label>
				<textarea id="addDescription" name="description" required></textarea>
			</div>

			<div>
				<label for="addEcheance">Date limite :</label>
				<input type="date" id="addEcheance" name="echeance" required>
			</div>

			<div>
				<label for="addPriorite">Priorité :</label>
				<select id="addPriorite" name="priorite" required>
					<option value="Faible">Faible</option>
					<option value="Moyenne">Moyenne</option>
					<option value="Forte">Forte</option>
				</select>
			</div>

			<div>
				<label for="addStatut">Statut :</label>
				<select id="addStatut" name="statut" required>
					<option value="A Faire">À Faire</option>
					<option value="En cours">En cours</option>
					<option value="Terminée">Terminée</option>
				</select>
			</div>

			<button type="submit">Créer</button>
		</form>
	</div>
</div>

<script src="/assets/js/tache_util.js"></script>

<!-- Popup Bouton partager -->
<div id="popupShare" class="popup-share" style="display: none;">
	<div class="popup-share-content">
		<span class="popup-share-close" onclick="closeSharePopup()">&times;</span>
		<h2>Partager un projet</h2>
		<form id="shareProjectForm" method="POST" action="/projet/partager">
			<input type="hidden" name="idprojet" value="<?= esc($projet['idprojet']) ?>">
			<div>
				<label for="popupShareUserSearch">Ajouter un utilisateur :</label>
				<input type="text" id="popupShareUserSearch" name="mailUser" placeholder="Entrez le mail de l'utilisateur..." required>
			</div>
			<button type="submit" class="btn btn-primary">Partager</button>
		</form>

		<h3>Utilisateurs du projet :</h3>
		<ul id="popupShareUserList">
			<?php if (!empty($utilisateurs)): ?>
				<?php foreach ($utilisateurs as $utilisateur): ?>
					<li>
						<?= esc($utilisateur['prenom']) ?> <?= esc($utilisateur['nom']) ?> 
						<span style="color: #888; font-size: 0.9em;">| <?= esc($utilisateur['mail']) ?></span>
					</li>
				<?php endforeach; ?>
			<?php else: ?>
				<li>Aucun utilisateur dans ce projet.</li>
			<?php endif; ?>
		</ul>
	</div>
</div>
