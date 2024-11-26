<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inscription</title>
</head>

<body>
	<h1>Inscription</h1>
	
	<?php if (isset($validation)): ?>
		<div style="color: red;">
			<?= $validation->listErrors() ?>
		</div>
	<?php endif; ?>

	<form action="/signup/store" method="post">
		<label for="mail">E-mail :</label>
		<input type="email" name="mail" id="mail" value="<?= old('mail') ?>" required>
		<?php if (isset($validation) && $validation->hasError('email')): ?>
			<div style="color: red;">
				<?= $validation->getError('email') ?>
			</div>
		<?php endif; ?>
		<br>
		
		<label for="nom">Nom :</label>
		<input type="text" name="nom" id="nom" value="<?= old('nom') ?>" required>
		<br>
		
		<label for="prenom">Prénom :</label>
		<input type="text" name="prenom" id="prenom" value="<?= old('prenom') ?>" required>
		<br>
		
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" id="password" required>
		<br>
		
		<label for="confirmpassword">Confirmer le mot de passe :</label>
		<input type="password" name="confirmpassword" id="confirmpassword" required>
		<br>
		
		<button type="submit">S'inscrire</button>
	</form>
	
	<a href="/signin">Déjà un compte ? Connectez-vous</a>
</body>

</html>
