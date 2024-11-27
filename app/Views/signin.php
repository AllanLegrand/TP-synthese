<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/connexion.css">
</head>
<body>
    <div class="signin-container">
        <!-- Partie gauche -->
        <div class="left-side">
            <img src="/assets/img/PF-2.png" alt="Logo">
        </div>

        <!-- Partie droite -->
        <div class="right-side">
            <form action="/SigninController/loginAuth" method="post">
                <h3>Connexion</h3>
                <label for="mail">E-mail :</label>
                <input type="email" name="email" id="mail" placeholder="Entrez votre adresse e-mail" required>
                
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>
                
                <a href="/forgot-password">Mot de passe oublié ?</a>
                
                <button type="submit">Se connecter</button>
                <a href="/signup">
                    <button type="button" class="signup">Créer un compte</button>
                </a>
            </form>
        </div>
    </div>
</body>
</html>
