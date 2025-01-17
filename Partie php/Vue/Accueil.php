<?php

require_once 'autoload.php';
require 'Verif-Auth.php';

use Controleur\ControleurPageAccueil;
use Controleur\ControleurPageJoueurs;

$idManager = $_POST["idmanager"] ?? " ";

$idManager = "KTomato";

$controleur = new ControleurPageAccueil();
$controleurJoueurs = new ControleurPageJoueurs();


$infoManager = $controleur->infoPageAccueil($idManager);


$listeMatchs = $controleur->getMatchsRecents();
$matchs ="";
foreach ($listeMatchs as $match) {
    $id_match =$match->getIdMatch();

    $resultat = $controleur->afficherResultat($match->getResultat());
    $adversaire = $match->getAdversaire();
    $lieu = $controleur->afficherLieu($match->getLieu());
    $date_heure = $match->getDate_et_heure();
    $bestJoueur = $controleur->getMeilleurJoueur($id_match);
    $n_licence =$bestJoueur->getN_licence();

    $commentaire = $controleur->getCommentaireJoueur($n_licence, $date_heure);
    $participation = $controleur->getParticipation($n_licence, $id_match);
    $note=$participation->getNote();

   
    $matchs .= '
    <div class="match">
        <h4 class="matchTitle">' . $resultat . '</h4>
        <p class="matchText">[Notre Equipe] vs ' . $adversaire . ' </p>
        <p class="matchText">Le ' . $date_heure . '  ' . $lieu . '</p>
        <h4 class="matchTextMJ">Meilleur joueur :</h4>
        <div class="mj">
            <div>
                <h5>' . $bestJoueur->getNom() . ' ' . $bestJoueur->getPrenom() . '</h5> 
                <span>' . str_repeat('★', $note) . str_repeat('☆', 5 - $note) . '</span>
                <p>' . $commentaire . '</p>
            </div>
        </div>
    </div>';
}


$listeJoueurs = $controleur->getJoueursActifs();
$joueurs = "";

foreach ($listeJoueurs as $joueur) {
    $nom = $joueur->getNom();
    $prenom = $joueur->getPrenom();
    $note = $controleurJoueurs->getNoteMoyenneJoueur($joueur->getN_licence());

    $joueurs .= '
    <div class="joueur">
        <div>
            <h5>' . $nom . ' ' . $prenom . '</h5> 
            <span>' . str_repeat('★', $note) . str_repeat('☆', 5 - $note) . '</span> 
        </div>
    </div>';
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/Accueil-Style.css">
    <title>Handi-Team Manager</title>
</head>
    <body>



        <?php include "barre-navigation.php" ?>

        <!-- Page content -->
        <div class="main">
            <h2>Bienvenue sur Handi-Team Manager,</h2>
            <h3><?php echo($infoManager) ?></h3>

            <!-- Matchs -->
            <div class="MatchRecentTitre"><h3>Matchs récents :</h3></div>
            <div class="flexContainer">

                <?php echo($matchs); ?>


            </div>
            <!-- Joueurs Disponibles -->
            <div class="MatchRecentTitre"><h3>Joueurs disponibles :</h3></div>
            <div class="flexContainer">
                <?php echo($joueurs); ?>
            </div>

        </div>
    </body>
</html>
