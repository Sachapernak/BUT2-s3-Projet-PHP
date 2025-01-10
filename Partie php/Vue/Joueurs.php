<?php

require_once 'autoload.php';
use Controleur\ControleurPageJoueurs;

$controleur = new ControleurPageJoueurs();
$listeJoueurs = $controleur->getJoueurs();

$joueurs = ""; // Chaîne pour accumuler le HTML

foreach ($listeJoueurs as $joueur) {
    // Extraction des informations du joueur
    $nom = htmlspecialchars($joueur['nom']);
    $prenom = htmlspecialchars($joueur['prenom']);
    $nLicence = htmlspecialchars($joueur['N_Licence']);
    $statut = htmlspecialchars($joueur['statut']);
    
    // Construction du HTML pour chaque joueur
    $joueurs .= '
    <div class="joueur">
        <div>
            <h5>' . $nom . ' ' . $prenom . '</h5>
            <h6> N° de licence : ' . $nLicence . '</h6>
            <h6> Statut : ' . $statut . '</h6>
            <span>★★★☆☆</span> <!-- Vous pouvez ajuster les étoiles dynamiquement si nécessaire -->
        </div>
    </div>';
}

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/Joueurs-Style.css">
    <title>Handi-Team Manager</title>
</head>

<body>

    <?php include "barre-navigation.html" ?>


    <!-- Page content -->
    <div class="main">
        <h2>Vos joueurs</h2>

        <div class="en-tete">
            <div class="recherche">
                <input type="text" id="search-bar" name="searchbar" placeholder="Rechercher un joueur...">
                <button id="search-button">🔍</button>
            </div>

            <div class="boutons-ajout">
                <button id="btn-ajouter-joueur" onclick="window.location.href='Ajouter-Joueur.php'"> Nouveau Joueur</button>
            </div>

            <div class="flexContainer">
                <?php echo $joueurs; ?>
            </div>

        </div>
    </div>
</body>

</html>