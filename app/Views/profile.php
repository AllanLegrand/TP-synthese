<body>
	<!-- Contenu principal -->
	<main>
		<div class="profile-card">
			<h3>Mon Profil</h3>
			<p><strong>Prénom :</strong> <?= esc($user['prenom']) ?></p>
			<p><strong>Nom :</strong> <?= esc($user['nom']) ?></p>
			<p><strong>Email :</strong> <?= esc($user['mail']) ?></p>

			<!-- Bouton pour afficher la popup -->
			<button onclick="openModalInfos()">Modifier mes informations</button>
			<!-- appele de la fonction deconnexion dans le controller -->
			<a href="/profile/logout"><button type="button" class="deconnexion">Se déconnecter</button></a>
			<!-- Bouton Supprimer mon compte -->
			 <br>
			<button id="deleteAccountBtn" class="btn btn-danger">Supprimer mon compte</button>
		</div>
	</main>

	<!-- Popup (modal) -->
	<div id="editModal" class="modal d-none">
		<div class="modal-content">
			<span class="close" onclick="closeModalInfos()">&times;</span>
			<h3>Modifier mes informations</h3>
			<form action="/profile/update" method="post">
				<div>
					<label for="prenom">Prénom</label>
					<input type="text" name="prenom" id="prenom" value="<?= esc($user['prenom']) ?>" required>
				</div>
				<div>
					<label for="nom">Nom</label>
					<input type="text" name="nom" id="nom" value="<?= esc($user['nom']) ?>" required>
				</div>
				<button type="submit">Enregistrer</button>
			</form>
		</div>
	</div>



	<!-- Boîte de dialogue de confirmation -->
	<div id="confirmDialog" class="dialog-overlay" style="display: none;">
		<div class="dialog-box">
			<h3>Confirmer la suppression</h3>
			<p>Êtes-vous sûr de vouloir supprimer votre compte ? <br>
				Cette action est irréversible et entraînera la perte de toutes vos données associées.</p>
			<button id="confirmDelete" class="btn btn-danger">Confirmer</button>
			<button id="cancelDelete" class="btn btn-secondary">Annuler</button>
		</div>
	</div>

	<script>
		// Ouvrir la popup
		function openModalInfos() {
			document.getElementById('editModal').classList.remove('d-none');
		}

		// Fermer la popup
		function closeModalInfos() {
			document.getElementById('editModal').classList.add('d-none');
		}

		document.addEventListener("DOMContentLoaded", function () {
			const deleteAccountBtn = document.getElementById("deleteAccountBtn");
			const confirmDialog = document.getElementById("confirmDialog");
			const confirmDelete = document.getElementById("confirmDelete");
			const cancelDelete = document.getElementById("cancelDelete");

			// Afficher la boîte de dialogue
			deleteAccountBtn.addEventListener("click", () => {
				confirmDialog.style.display = "flex";
			});

			// Cacher la boîte de dialogue
			cancelDelete.addEventListener("click", () => {
				confirmDialog.style.display = "none";
			});

			// Confirmer la suppression (appel à la fonction du contrôleur)
			confirmDelete.addEventListener("click", () => {
				// Redirige vers une fonction du contrôleur
				window.location.href = "/profile/suppr";
			});
		});

	</script>
</body>