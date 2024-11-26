<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
</head>
<body>
    <h1>Bonjour, <?= esc($user['prenom']) ?> !</h1>

    <p><strong>Email :</strong> <?= esc($user['mail']) ?></p>
    <!-- <p><strong>Date de création :</strong> <\?= esc($user['created_at']) ?></p> 

    <br><br>
    <a href="/profile/edit">Modifier mes informations</a>--> 

	<br><br>
    <a href="/profile/logout">
        <button type="button">Se déconnecter</button>
    </a>
</body>
</html>
