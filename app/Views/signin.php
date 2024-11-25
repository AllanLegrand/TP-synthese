<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Connexion</title>
</head>

<body>
	<h1>Connexion</h1>
	<?php if (session()->getFlashdata('msg')): ?>
		<div style="color: red;">
			<?= session()->getFlashdata('msg') ?>
		</div>
	<?php endif; ?>
	<form action="/SigninController/loginAuth" method="post">
		<label for="email">E-mail :</label>
		<input type="email" name="email" id="email" required>
		<br>
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" id="password" required>
		<br>
		<button type="submit">Se connecter</button>
	</form>
	<a href="/forgot-password">Mot de passe oublié ?</a>
</body>

</html>