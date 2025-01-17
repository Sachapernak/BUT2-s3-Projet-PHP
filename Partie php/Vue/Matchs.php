<?php

require_once 'autoload.php';
require 'Verif-Auth.php';
use Controleur\ControleurPageMatchs;

$controleurMatchs = new ControleurPageMatchs();

$listeMatchs = $controleurMatchs->getMatchsAVenir();
$listeMatchsPasses = $controleurMatchs->getMatchsPasses();

$matchAVenir = false;

$listeJoueurs = [];
$idMatch = null;
if (isset($_POST['id_match'])) {
    $idMatch = (int) $_POST['id_match'];
    $listeJoueurs = $controleurMatchs->getJoueursParticipants($idMatch);

    foreach ($listeMatchs as $match) {
        if ($match->getIdMatch() == $idMatch) {
            $matchAVenir = true;
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'supprimer') {
    if (isset($_POST['id_match'])) {
        $idMatch = (int) $_POST['id_match'];
        $controleurMatchs->supprimerMatch($idMatch);
        $listeMatchs = $controleurMatchs->getMatchsAVenir();
    }
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
                <a href="Saisie-Note.php?idJoueur=' . urlencode($n_licence) . '&idMatch=' . urlencode($idMatch) . '" class="saisie-note">
                    <i class="fa-solid fa-notes-medical" style="color: #f3ad35;"></i>

                </a>
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

    <?php include "barre-navigation.php" ?>

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
                            echo '<td>' . $controleurMatchs->afficherLieu($match->getLieu()) . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>

        <div class="btn-container">
            <button class="btn" onclick="window.location.href='Ajouter-match.php?'">Ajouter un match</button>
            <form method="POST" action="">
                <input type="hidden" name="action" value="supprimer">
                <input type="hidden" name="id_match" value="<?php echo $idMatch; ?>">
                <button type="submit" class="btn" <?php if (!$matchAVenir)
                    echo 'disabled'; ?>>Annuler le match</button>
            </form>
            <button class="btn" <?php if (!$matchAVenir)
                echo 'disabled'; ?>
                onclick="window.location.href='Modifier-Un-Match.php?idMatch=<?php echo urlencode($idMatch); ?>'">Modifier
                le match</button>
        </div>


        <h3> Ensemble des matchs passés </h3>

        <div class="table-container">
            <form action="" method="POST">
                <table>
                    <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Date et heure</th>
                            <th>Adversaire</th>
                            <th>Lieu</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listeMatchsPasses as $match) {
                            $ligneSelect = '';
                            if (isset($_POST['id_match']) && $_POST['id_match'] == $match->getIdMatch()) {
                                $ligneSelect = 'ligneSelect';
                            }
                            echo '<tr class="clickable-row ' . $ligneSelect . '">';
                            echo '<td><button type="submit" name="id_match" value="' . $match->getIdMatch() . '" class="invisible-btn"></button>' . $match->getIdMatch() . '</td>';
                            echo '<td>' . $match->getDate_et_heure() . '</td>';
                            echo '<td>' . $match->getAdversaire() . '</td>';
                            echo '<td>' . $controleurMatchs->afficherLieu($match->getLieu()) . '</td>';
                            echo '<td>' . $controleurMatchs->afficherResultat($match->getResultat()) . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>

        <div class="btn-container">
            <button class="btn" <?php if ($matchAVenir)
                echo 'disabled'; ?>
                onclick="window.location.href='Saisie-Du-Score.php?idMatch=<?php echo urlencode($idMatch); ?>'">Saisir le score
            </button>
        </div>

        <div id="selection-jouer">
            <h3>Joueurs participants au match n°<?php echo $idMatch ?> </h3>
            <div class="btn-container">
                <button class="btn" <?php if (!$matchAVenir)
                    echo 'disabled'; ?>
                    onclick="window.location.href='Feuille-De-Match.php?idMatch=<?php echo urlencode($idMatch); ?>'"> Selectionner les joueurs </button>
            </div>

        </div>


        <div class="flexContainer">
            <?php echo $joueurs; ?>
        </div>

    </div>
</body>

</html>