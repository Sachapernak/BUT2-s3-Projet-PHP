<?php

require_once 'autoload.php';
use Controleur\ControleurPageMatchs;

$controleurMatchs = new ControleurPageMatchs();

$listeMatchs = $controleurMatchs->getMatchsAVenir();

$listeJoueurs = [];
$idMatch = null;
if (isset($_POST['id_match'])) {
    $idMatch = (int) $_POST['id_match'];
    $listeJoueurs = $controleurMatchs->getJoueursParticipants($idMatch);
}

$joueurs = "";

foreach ($listeJoueurs as $joueur) {
    $n_licence = $joueur->getN_licence();
    $jouer = $controleurMatchs->getInfosParticipants($idMatch, $n_licence);

    $poste = $jouer->getRole();
    $estRemplacant = $controleurMatchs->afficherRemplacement($jouer->getEst_remplacant());
    $note = $jouer->getNote();

    $nom = $joueur->getNom();
    $prenom = $joueur->getPrenom();
    $etoiles = $controleurMatchs->afficherEtoiles($note);

    $joueurs .= '
        <div class="joueur">
            <div>
                <div class="en-tete-joueur">
                    <h5>' . $nom . ' ' . $prenom . '</h5> <span>' . $etoiles . ' </span>
                </div> 
                <div class ="infosJoueur"> 
                    <p> Licence ' . $n_licence . ' </p> <br>
                    <p> Poste : ' . $poste . '</p> <br>
                    <p> ' . $estRemplacant . '</p> <br>
                </div>
            </div>
        </div>
    ';
}

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/Matchs-Style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Handi-Team Manager</title>
</head>

<body>

    <?php include "barre-navigation.html" ?>

    <!-- Page content -->
    <div class="main">
        <h2> Les matchs à venir </h2>

        <div class="table-container">
            <form action="" method="POST">
                <table>
                    <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Date et heure</th>
                            <th>Adversaire</th>
                            <th>Lieu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listeMatchs as $match) {

                            $ligneSelect = '';
                            if (isset($_POST['id_match']) && $_POST['id_match'] == $match->getIdMatch()) {
                                $ligneSelect = 'ligneSelect';  
                            }

                            echo '<tr class="clickable-row ' . $ligneSelect . '">';
                            echo '<td><button type="submit" name="id_match" value="' . $match->getIdMatch() . '" class="invisible-btn"></button>' . $match->getIdMatch() . '</td>';
                            echo '<td>' . $match->getDate_et_heure() . '</td>';
                            echo '<td>' . $match->getAdversaire() . '</td>';
                            echo '<td>' . $match->getLieu() . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </form>

        </div>

        <div class="btn-container">
            <button class="btn" onclick="window.location.href='Feuille-De-Match.php?'">Ajouter un match</button>
            <button class="btn">Annuler le match</button>
            <button class="btn"  onclick="window.location.href='Feuille-De-Match.php?idMatch=<?php echo urlencode($idMatch); ?>'">Modifier le match</button>
        </div>

        <h3>Joueurs participants au match n°<?php echo $idMatch ?> </h3>

        <div class="flexContainer">
            <?php echo $joueurs; ?>
        </div>
    </div>
</body>

</html>