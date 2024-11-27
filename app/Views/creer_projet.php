<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de projet</title>
</head>
<body>
    <h1>Créer un nouveau projet</h1>


    <form action="/creer" method="post">
        <?= csrf_field() ?>

        <label for="titreprojet">Titre du projet :</label>
        <input type="text" name="titreprojet" id="titreprojet" required><br>

        <label for="descriptionprojet">Description du projet :</label>
        <textarea name="descriptionprojet" id="descriptionprojet" required></textarea><br>

        <button type="submit">Créer le projet</button>
    </form>

    <p><a href="/projets">Retour à la liste des projets</a></p>
</body>
</html>
