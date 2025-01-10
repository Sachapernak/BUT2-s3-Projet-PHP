<?php

require_once 'autoload.php';
use Controleur\ControleurPageAjouterJoueur;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controleur = new ControleurPageAjouterJoueur();
    $controleur->ajouterJoueur();
}

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/Ajouter-Joueur-Style.css">
    <title>Handi-Team Manager</title>
</head>

<body>

    <?php include "barre-navigation.html" ?>

    <div class="main">


        <div class="form-container">
            <h2>Nouveau Joueur</h2>
            <form action="Ajouter-Joueur.php" method="POST">
                <label for="licence">N° licence :</label>
                <input type="text" id="licence" name="licence" placeholder="Licence">

                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" placeholder="Nom">

                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" placeholder="Prénom">

                <label for="statut" >Statut :</label>
                <select id="statut" name="statut">
                    <option value="actif">Actif</option>
                    <option value="absent">Absent</option>
                    <option value="blesse">Blessé</option>
                    <option value="suspendu">Suspendu</option>
                </select>

                <label for="date_naissance">Date de naissance :</label>
                <input type="date" id="date_naissance" name="date_naissance">

                <label for="taille">Taille (cm) :</label>
                <input type="number" id="taille" name="taille" placeholder="cm" min="0">

                <label for="poids" >Poids (kg) :</label>
                <input type="number" id="poids" name="poids" placeholder="kg" min="0">

                <div class="form-buttons">
                    <button type="submit" class="btn btn-valider">Valider</button>
                    <button type="button" class="btn btn-annuler" onclick="window.location.href='Joueurs.php'">Annuler</button>
                </div>
            </form>
        </div>



    </div>
</body>

</html>