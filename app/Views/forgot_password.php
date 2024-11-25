<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mot de passe oublié</title>
</head>

<body>
	<h1>Mot de passe oublié</h1>
	<form action="/forgot-password/sendResetLink" method="post">
		<label for="email">E-mail :</label>
		<input type="email" name="email" id="email" required>
		<br>
		<button type="submit">Envoyer le lien de réinitialisation</button>
	</form>
</body>

</html>