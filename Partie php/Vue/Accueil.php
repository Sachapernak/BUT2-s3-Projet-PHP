<?php

require_once 'autoload.php';
use Controleur\ControleurPageAccueil;

$idManager = $_POST["idmanager"] ?? " ";

$idManager = "KTomato";

$controleur = new ControleurPageAccueil();

$infoManager = $controleur->infoPageAccueil($idManager);

// Plus tard, remplacer tout cet html par une récupération des deux derniers
// matchs, avec une methode qui récupère les infos du match (getters) pour
// les mettre dans un string avec l'html
//
// Algo :
//  String = "";
//  Pour chaque matchs m :
//      String += "html" . m.getValeur1 . "html" . m.getValeur2...
//  Renvoyer le string qui contient l'html

// Pareil pour les joueurs

$match1 = '<div class="match">
                    <h4 class="matchTitle">[Victoire]</h4>
                    <p class="matchText">[NotreEquipe] vs [EquipeAdverse] </p>
                    <p class="matchText">Le [Date] à [Lieu] </p>
                    <h4 class="matchTextMJ">Meilleur joueur :</h4>
                    <div class="mj">
                        <div>
                            <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                            <p> Joueur extrêmement polyvalent, [Nom du joueur] démontre
                                une excellente maîtrise du fauteuil.</p>
                        </div>
                    </div>
            </div>';

$match2 = '<div class="match">
                    <h4 class="matchTitle">[Défaite]</h4>
                    <p class="matchText">[NotreEquipe] vs [EquipeAdverse] </p>
                    <p class="matchText">Le [Date] à [Lieu] </p>
                    <h4 class="matchTextMJ">Meilleur joueur :</h4>
                    <div class="mj">
                        <div>
                            <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                            <p> Joueur extrêmement polyvalent, [Nom du joueur] démontre
                                une excellente maîtrise du fauteuil.</p>
                        </div>
                    </div>
             </div>';

$matchs = $match1 . " " . $match2;

$joueursArray = array(
                '<div class="joueur">
                    <div>
                        <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                    </div>
                </div>',
                '<div class="joueur">
                    <div>
                        <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                    </div>
                </div>',
                '<div class="joueur">
                    <div>
                        <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                    </div>
                </div>',
                '<div class="joueur">
                    <div>
                        <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                    </div>
                </div>',
                '<div class="joueur">
                    <div>
                        <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                    </div>
                </div>',
                '<div class="joueur">
                    <div>
                        <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                    </div>
                </div>',
);
$joueurs = "";
foreach ($joueursArray as $joueur) {
    $joueurs .= $joueur;
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



        <?php include "barre-navigation.html" ?>

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
