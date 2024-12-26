<?php

$joueursArray = array(
    '<div class="joueur">
        <div>
            <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
            <h6> Licence [licence]</h6> 
        </div>
    </div>',
    '<div class="joueur">
        <div>
            <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
            <h6> Licence [licence]</h6> 
        </div>
    </div>',
    '<div class="joueur">
        <div>
            <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
            <h6> Licence [licence]</h6> 
        </div>
    </div>',
    '<div class="joueur">
        <div>
            <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
            <h6> Licence [licence]</h6> 
        </div>
    </div>',
    '<div class="joueur">
        <div>
            <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
            <h6> Licence [licence]</h6> 
        </div>
    </div>',
    '<div class="joueur">
        <div>
            <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
            <h6> Licence [licence]</h6> 
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
    <link rel="stylesheet" href="CSS/Matchs-Style.css">
    <title>Handi-Team Manager</title>
</head>

<body>

    <?php include "barre-navigation.html" ?>


    <!-- Page content -->
    <div class="main">
        <h2> Les matchs à venir </h2>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Adversaire</th>
                        <th>Lieu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>15/02/2022</td>
                        <td>18h00</td>
                        <td>Team XYZ</td>
                        <td>Stade ABC</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="btn-container">
            <button class="btn">Ajouter un match</button>
            <button class="btn">Annuler le match</button>
        </div>

        <h3>Joueurs participants :</h3>



        <div class="flexContainer">
                <?php echo $joueurs; ?>
        </div>

   </div>
</body>

</html>