<?php

require_once 'autoload.php';
use Controleur\ControleurPageFeuilleDeMatch;
use Controleur\ControleurPageJoueurs;

$controleurMatchs = new ControleurPageFeuilleDeMatch();
$controleurJoueurs = new ControleurPageJoueurs();

$listeJoueurs = $controleurMatchs->getJoueursActifs();

$joueurs = "";

foreach ($listeJoueurs as $joueur) {
    $nom = $joueur->getNom();
    $prenom = $joueur->getPrenom();
    $nLicence = $joueur->getN_licence();
    $statut = $joueur->getIntituleStatut();
    $noteMoyenne = $controleurJoueurs->afficherEtoiles($nLicence);

    $joueurs .= '
    <a class="divCliquable" href="#">
        <div class="joueur">
            <div class="attributs">
                <h5>' . $nom . ' ' . $prenom . ' N° de licence : ' . $nLicence . '</h5>
            </div>

            <!-- Formulaire de position et rôle  -->
            <form action="Feuille-De-Match.php" method="POST">
                <div class="participation-item">
                    <label for="position_' . $nLicence . '">Position :</label>
                    <select id="position_' . $nLicence . '" name="position[' . $nLicence . ']">
                        <option value="Meneur">Meneur</option>
                        <option value="Ailier">Ailier</option>
                        <option value="Pivot">Pivot</option>
                    </select>
                </div>

                <div class="participation-item">
                    <label for="role_' . $nLicence . '">Rôle :</label>
                    <select id="role_' . $nLicence . '" name="role[' . $nLicence . ']">
                        <option value="False">Titulaire</option>
                        <option value="True">Remplaçant</option>
                    </select>
                </div>

                <!-- Case à cocher pour chaque joueur -->
                <div class="checkbox">
                    <input type="checkbox" name="joueursSelectionnes[]" value="' . $nLicence . '">
                </div>
            </form>

        </div>
    </a>';
}




?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/Feuille-De-Match-Style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Handi-Team Manager</title>
</head>

<body>

    <?php include "barre-navigation.html" ?>
    <h2> Feuille de match </h2>

    <div class="main">


        <div class="infos-match-container">
            <h3>Le match</h3>
            <form action="Feuille-De-Match.php" method="POST">
                <div class="match-item">
                    <label for="date-et-heure">Date et heure </label>
                    <input type="date" id="date" name="date" required> <!-- Champ pour la date -->
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

        <div class="infos-joueur">
            <div class="liste-joueurs">
                <?php echo $joueurs; ?>
            </div>
            
        </div>

        


    </div>
</body>

</html>