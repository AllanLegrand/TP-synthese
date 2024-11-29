<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gestion des Tâches' ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/<?= strtolower($title) ?>.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
</head>
<body>
    <!-- Header avec navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="<?= base_url('Accueil') ?>">
                    <img src="/assets/img/PF.png" alt="Logo">
                </a>
                <!-- Boutons à gauche -->
                <!-- verifier si on a un idutil dans la session pour afficher les boutons -->
                <?php if (session()->has('idutil')) : ?>
                    <div class="d-flex align-items-center">
                        <!-- Lien "Projets" -->
                        <button class="btn btn-secondary" onclick="location.href='/projets';">Projets</button>
                        <!-- Bouton "Créer" -->
                        <button class="btn btn-primary" onclick="openModal()">Créer</button>
                    </div>
                <?php endif; ?>
                <!-- Barre de recherche + icône utilisateur -->
                <div class="ms-auto d-flex align-items-center position-relative">
                    <input type="text" class="form-control search-bar me-2" placeholder="Rechercher..." oninput="searchProjects(this.value)">
                    <div id="searchResults" class="search-results"></div>
                    <a href="<?= base_url('profile') ?>">
                        <img src="/assets/img/user.png" alt="Utilisateur" class="user-icon">
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Fenêtre modale -->
    <div id="popupModal" class="popup-modal">
        <div class="popup-content">
            <h2>Créer un Projet</h2>
            <!-- Formulaire ou contenu pour la création de projet -->
            <form action="<?= base_url('/creer_projet') ?>" method="post">
                <div class="mb-3">
                    <label for="titreprojet" class="form-label">Titre du projet</label>
                    <input type="text" class="form-control" id="titreprojet" name="titreprojet" required>
                </div>
                <div class="mb-3">
                    <label for="descriptionprojet" class="form-label">Description</label>
                    <textarea class="form-control" id="descriptionprojet" name="descriptionprojet" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn popup-creer">Créer</button>
                <button type="button" class="btn popup-annuler" onclick="closeModal()">Annuler</button>
            </form>
        </div>
    </div>
    <script src="/assets/js/header.js"></script>

