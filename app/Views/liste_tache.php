<header>
        <h1>Projet : <?= esc($projet['titreprojet']) ?></h1>
        <p>Description : <?= esc($projet['descriptionprojet']) ?></p>
    </header>

    <section>
        <h2>Liste des Tâches</h2>
        <?php if (!empty($taches)) : ?>
            <ul>
                <?php foreach ($taches as $tache) : ?>
                    <li>
                        <strong>Tâche:</strong> <?= esc($tache['titre']) ?><br>
                        <strong>Status:</strong> <?= esc($tache['statut']) ?><br>
                        <strong>Date limite:</strong> <?= esc($tache['echeance']) ?><br>
                        <a href="/projets/<?= esc($projet['idprojet']) ?>/<?= esc($tache['idtache']) ?>/modification">Modifier</a> |
                        <a href="/suppModif/<?= esc($tache['idtache']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Aucune tâche trouvée pour ce projet.</p>
        <?php endif; ?>
    </section>