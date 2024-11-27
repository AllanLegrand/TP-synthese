<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="/assets/css/inscription.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="signin-container">
        <!-- Partie gauche : Formulaire d'inscription -->
        <div class="left-side">
            <form action="/signup/store" method="post">
                <h3>Inscription</h3>
                <label for="mail">E-mail :</label>
                <input type="email" name="mail" id="mail" placeholder="Entrez votre adresse e-mail" required>
                <?php if (isset($validation) && $validation->hasError('email')): ?>
                    <div style="color: red;">
                        <?= $validation->getError('email') ?>
                    </div>
                <?php endif; ?>
                
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" placeholder="Entrez votre nom" required>
                
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" placeholder="Entrez votre prénom" required>
                
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>
                
                <label for="confirmpassword">Confirmer le mot de passe :</label>
                <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirmez votre mot de passe" required>
                
                <button type="submit">S'inscrire</button>
                <a href="/signin">
                    <button type="button" class="signin">Déjà un compte ?</button>
                </a>
            </form>
        </div>

        <!-- Partie droite : Fond violet avec logo -->
        <div class="right-side">
            <img src="/assets/img/PF-2.png" alt="Logo">
        </div>
    </div>
</body>
</html>
