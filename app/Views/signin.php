<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Connexion</title>
	<link href="/assets/css/connexion.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php if (session()->getFlashdata('msg')): ?>
		<div style="color: red;">
			<?= session()->getFlashdata('msg') ?>
		</div>
	<?php endif; ?>
	<form action="/SigninController/loginAuth" method="post">
		<h3>Connexion</h3>
		<label for="mail">E-mail :</label>
		<input type="mail" name="email" id="mail" placeholder="Entrez votre adresse e-mail" required>
		<br>
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>
		<br>
		<a href="/forgot-password">Mot de passe oublié ?</a>
		<br>
		<button type="submit">Se connecter</button>
		<a href="/signup">
			<button type="button" class="signup">Créer un compte</button>
		</a>
	</form>
</body>
</html>
