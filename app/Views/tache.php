<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification tâche</title>
</head>
<body>
    <h1>Modification tâche</h1>
    <form action="<?= base_url('tache/enregistrer') ?>" method="post">
        <input type="hidden" name="idtache" value="<?= esc($tache['idtache']) ?>">

        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" value="<?= esc($tache['titre']) ?>" required><br>

        <label for="description">Description :</label>
        <textarea name="description" id="description" required><?= esc($tache['description']) ?></textarea><br>

        <label for="statut">Statut :</label>
        <select name="statut" id="statut">
            <option value="en cours" <?= $tache['statut'] == 'en cours' ? 'selected' : '' ?>>En cours</option>
            <option value="terminée" <?= $tache['statut'] == 'terminée' ? 'selected' : '' ?>>Terminée</option>
        </select><br>

        <label for="echeance">Date limite :</label>
        <input type="date" name="echeance" id="echeance" value="<?= esc($tache['echeance']) ?>"><br>

        <button type="submit">Enregistrer</button>
        <a href="<?= base_url('projets/' . esc($tache['idprojet'])) ?>">Annuler</a>
    </form>
</body>
</html>
