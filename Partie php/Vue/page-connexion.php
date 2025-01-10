<?php
// connexion.php

require_once 'autoload.php';
use Controleur\ControleurConnexion;

session_start();

$controleur = new ControleurConnexion();

$erreurMessage = $controleur->getMessageErreur();

// Si la requête est de type POST (le formulaire a été soumis)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login    = $_POST['login']    ?? '';
    $password = $_POST['password'] ?? '';

    echo($login . " " . $password);


    $controleur->processLogin($login, $password);
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/Connexion-Style.css">
    <title>Connexion</title>
</head>
<body>
<div class="flex-container">
    <div id="bloc-connexion">
        <div id="titre">
            <h2>Connexion</h2>
        </div>


        <!-- Le formulaire de connexion pointe vers la même page, qui traitera les données en POST -->
        <form method="post" action="">
            <div class="form-group">
                <label for="login">Nom d'utilisateur :</label>
                <input type="text" id="login" name="login" class="champs-saisi" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" class="champs-saisi" required>
            </div>
            <input type="submit" value="Se connecter" id="btn-submit">
        </form>
    </div>
</div>
</body>
</html>
