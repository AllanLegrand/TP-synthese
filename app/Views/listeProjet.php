<h1>Liste des Projets</h1>

<?php if (!empty($projets)): ?>
    <ul>
        <?php foreach ($projets as $projet): ?>
            <li>
                <strong><?= esc($projet['titreprojet']) ?></strong>
                <p><?= esc($projet['descriptionprojet']) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun projet trouvé.</p>
<?php endif; ?>
