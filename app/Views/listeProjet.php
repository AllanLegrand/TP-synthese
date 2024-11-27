<?php if (!empty($projets)): ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Mes Projets</h1>
        <div class="project-grid">
            <?php foreach ($projets as $projet): ?>
                <div class="project-card">
                    <h3><?= esc($projet['titreprojet']) ?></h3>
                    <p><?= esc($projet['descriptionprojet']) ?></p>
                    
                    <p>
                        <strong>Tâches :</strong> 
                        <?= "1/8"/*esc($projet['taches_terminees']) ?>/<?= esc($projet['total_taches']) */?>
                    </p>
                    <a href="<?= base_url('projets/' . $projet['idprojet']) ?>" class="btn btn-primary">Voir Détails</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <h1 class="text-center mb-4">Mes Projets</h1>
    <p>Aucun projet trouvé.</p>
<?php endif; ?>
