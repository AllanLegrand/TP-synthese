<header>
        <h1>Projet : <?= esc($titre) ?></h1>
        <p>Description : <?= esc($description) ?></p>
        <a href="/path/to/back" class="back-button">Retour aux projets</a>
    </header>

    <section>
        <h2>Liste des Tâches</h2>
        <?php if (!empty($taches)) : ?>
            <ul>
                <?php foreach ($taches as $tache) : ?>
                    <li>
                        <strong>Tâche:</strong> <?= esc($tache['nom_tache']) ?><br>
                        <strong>Status:</strong> <?= esc($tache['status']) ?><br>
                        <strong>Date limite:</strong> <?= esc($tache['date_limite']) ?><br>
                        <a href="/path/to/edit/<?= esc($tache['id_tache']) ?>">Modifier</a> |
                        <a href="/path/to/delete/<?= esc($tache['id_tache']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Aucune tâche trouvée pour ce projet.</p>
        <?php endif; ?>
    </section>