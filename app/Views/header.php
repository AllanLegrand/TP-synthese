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
                <div class="d-flex align-items-center">
                    <!-- Lien "Projets" -->
                    <a class="nav-link me-3" href="<?= base_url('Projets') ?>">Projets</a>
                    <!-- Bouton "Créer" -->
                    <button class="btn btn-primary" onclick="location.href='<?= base_url('creer') ?>';">Créer</button>
                </div>
                <!-- Barre de recherche + icône utilisateur -->
                <div class="ms-auto d-flex align-items-center">
                    <input type="text" class="form-control search-bar me-2" placeholder="Rechercher...">
                    <a href="<?= base_url('profile') ?>">
                        <img src="/assets/img/user.png" alt="Utilisateur" class="user-icon">
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Contenu principal -->
    <main class="container mt-4">
