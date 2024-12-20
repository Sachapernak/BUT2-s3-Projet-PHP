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
    <div id=bloc-connexion>
        <h2>Connexion</h2>
        <form method="post" action="/login">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required><br><br>
    
            <input type="submit" value="Se connecter">
    </div>
</body>
</html>
