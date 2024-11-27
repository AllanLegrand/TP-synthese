<body>


	<!-- Contenu principal -->
	<main class="container" style="height: calc(100vh - 80px);">
		<div class="profile-card p-4 bg-white shadow rounded" style="width: 100%; max-width: 500px;">
			<h3 class="text-center mb-4">Mon Profil</h3>
			<p><strong>Prénom :</strong> <?= esc($user['prenom']) ?></p>
			<p><strong>Nom :</strong> <?= esc($user['nom']) ?></p>
			<p><strong>Email :</strong> <?= esc($user['mail']) ?></p>

			<!-- Bouton pour modifier les informations -->
			<button class="btn" onclick="toggleEditForm()">Modifier mes informations</button>

			<!-- Formulaire caché -->
			<form id="editForm" action="/profile/update" method="post" class="mt-4 d-none">
				<div class="mb-3">
					<label for="prenom" class="form-label">Prénom</label>
					<input type="text" name="prenom" id="prenom" class="form-control"
						value="<?= esc($user['prenom']) ?>" required>
				</div>
				<div class="mb-3">
					<label for="nom" class="form-label">Nom</label>
					<input type="text" name="nom" id="nom" class="form-control" value="<?= esc($user['nom']) ?>"
						required>
				</div>
				<button type="submit" class="btn btn-success w-100">Enregistrer</button>
			</form>
		</div>
	</main>

	<script>
		function toggleEditForm() {
			const form = document.getElementById('editForm');
			form.classList.toggle('d-none');
		}
	</script>
</body>

</html>