<?php
?>

<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./CSS/Connexion-Style.css">
    <title>Connexion</title>
</head>
<body>
    <div class=flex-container>
        <div id=bloc-connexion>
            <div id='titre'> 
                <h2>Connexion</h2>
            </div>
            <form method="post" action="/login">
                <div class="form-group">
                    <label for="login">Nom d'utilisateur :</label>
                    <input type="login" id="login" name="login" class="champs-saisi" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" class="champs-saisi" required>
                </div>
                <input type="submit" value="Se connecter" id=btn-submit>
            </form>
        </div>
    </div>
</body>
</html>
