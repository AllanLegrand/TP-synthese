<body>
	<!-- Contenu principal -->
	<main>
		<div class="profile-card">
			<h3>Mon Profil</h3>
			<p><strong>Prénom :</strong> <?= esc($user['prenom']) ?></p>
			<p><strong>Nom :</strong> <?= esc($user['nom']) ?></p>
			<p><strong>Email :</strong> <?= esc($user['mail']) ?></p>

			<!-- Bouton pour afficher la popup -->
			<button onclick="openModal()">Modifier mes informations</button>
			<button type="button" class="deconnexion">Se déconnecter</button>
		</div>
	</main>

	<!-- Popup (modal) -->
	<div id="editModal" class="modal d-none">
		<div class="modal-content">
			<span class="close" onclick="closeModal()">&times;</span>
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

	<script>
		// Ouvrir la popup
		function openModal() {
			document.getElementById('editModal').classList.remove('d-none');
		}

		// Fermer la popup
		function closeModal() {
			document.getElementById('editModal').classList.add('d-none');
		}
	</script>
</body>
