<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="./projetPHP_css/page_connexion.css">
</head>
<body>
    <div class="container">
        <!-- Bloc de gauche -->
        <div class="bloc_gauche">
            <div class="icon-container">
                <!--<img src="laptop-icon.png" alt="Laptop Icon" />-->
            </div>
        </div>

        <!-- Bloc de droite -->
        <div class="bloc_droite">
            <h2>Connexion</h2>
            <form method="post" action="">
                <div class="saisie">
                    <label for="login">Login :</label>
                    <input type="text" id="login" name="login" required>
                </div>
                <div class="saisie">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-btn">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>
