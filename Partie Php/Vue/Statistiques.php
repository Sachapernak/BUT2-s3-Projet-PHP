<?php

require_once 'autoload.php';
use Controleur\ControleurPageStatistiques;
use Controleur\ControleurPageJoueurs;

$controleurStats = new ControleurPageStatistiques();

$nbVictoires = $controleurStats->getTotalVictoires();
$nbDefaites = $controleurStats->getTotalDefaites();
$nbNuls = $controleurStats->getTotalNuls();

$pourcentVictoires = $controleurStats->getPourcentVictoires();
$pourcentDefaites = $controleurStats->getPourcentDefaites();
$pourcentNuls = $controleurStats->getPourcentNuls();

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/Statistiques-Style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Handi-Team Manager</title>
</head>

<body>

    <?php include "barre-navigation.html" ?>

    <div class="main">
        <h2>Récapitulatif des matchs</h2>
        <div class="stats-match-container">


            <div class="recapitulatifMatch">
                <h3 style="color: #4CAF50;">Victoires</h3>
                <p><?php echo $pourcentVictoires ?> %</p>
                <p>Nombre de victoires <?php echo $nbVictoires ?></p>
            </div>

            <div class="recapitulatifMatch">
                <h3 style="color: #e55c36;">Nuls</h3>
                <p><?php echo $pourcentNuls ?> % </p>
                <p>Nombre de matchs nuls <?php echo $nbNuls ?></p>
            </div>

            <div class="recapitulatifMatch">
                <h3 style="color: #BC321D;">Défaites</h3>
                <p><?php echo $pourcentDefaites ?> %</p>
                <p>Nombre de matchs défaites <?php echo $nbDefaites ?></p>
            </div>

        </div>

        <h2> Récapitulatif des joueurs </h2>

        <div class="stats-joueur-container">
            <table class="recap-joueur-table">
                <thead>
                    <tr>
                        <th>Joueur</th>
                        <th>Statut</th>
                        <th>Poste favoris</th>
                        <th>Titulirations</th>
                        <th>Remplacements</th>
                        <th>Moyenne des évaluations</th>
                        <th>Nb matchs consécutifs</th>
                        <th>Matchs gagnés (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $controleurStats = new ControleurPageStatistiques();
                    $controleurJoueurs = new ControleurPageJoueurs();
                    $joueurs = $controleurJoueurs->getJoueurs();


                    if ($joueurs):
                        foreach ($joueurs as $joueur): ?>

                            <tr>
                                <td><?php echo htmlspecialchars($joueur->getNom() . " " . $joueur->getPrenom()); ?></td>
                                <td><?php echo htmlspecialchars($joueur->getIntituleStatut()); ?></td>
                                <td><?php 
                                    $posteFav = $controleurStats->getPosteFavoris($joueur);                              
                                    echo $posteFav; ?>
                                </td>
                                <td><?php 
                                    $titularisations = $controleurStats->getTitularisations($joueur);                              
                                    echo $titularisations; ?>
                                </td>
                                <td><?php 
                                    $remplacements = $controleurStats->getRemplacements($joueur);                              
                                    echo $remplacements; ?>
                                </td>
                                <td><?php 
                                    $moyenneEval = $controleurStats->getMoyenneEval($joueur);                              
                                    echo $titularisations; ?>
                                </td>
                                <td><?php 
                                    $nbMatchsConscutifs = $controleurStats->getMatchsConsecutifs($joueur);                              
                                    echo $nbMatchsConscutifs; ?>
                                </td>
                                      
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="2">Aucun commentaire pour ce joueur.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
</body>

</html>