<?php
require_once 'autoload.php';
use Controleur\ControleurPageAjouterMatch;

$controleur = new ControleurPageAjouterMatch();



// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controleur->creerUnMatch();
}

?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/Ajouter-Match-Style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Handi-Team Manager</title>
</head>

<body>

    <?php include "barre-navigation.html" ?>
  
    <div class="main">


        <div class="infos-match-container">
            <h2>Le match</h2>
            <form action="Ajouter-match.php" method="POST">
                <div class="match-item">
                    <label for="date-et-heure">Date et heure </label>
                    <input type="date" id="date" name="date" required>
                    <input type="time" id="heure" name="heure" required>
                </div>

                <div class="match-item">
                    <label for="adversaire">Adversaire :</label>
                    <input type="text" id="adversaire" name="adversaire" placeholder="Adversaire" required>

                    <label for="lieu">Lieu :</label>
                    <select id="lieu" name="lieu">
                        <option value="dom">A domicile</option>
                        <option value="ext">Extérieur</option>
                    </select>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn btn-valider">Valider</button>
                    <button type="button" class="btn btn-annuler"
                        onclick="window.location.href='Matchs.php'">Annuler</button>
                </div>
            </form>
        </div>

    </div>
</body>

</html>