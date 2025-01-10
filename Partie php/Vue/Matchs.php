<?php
$matchs = [
    ['date' => '15/02/2022', 'heure' => '18h00', 'adversaire' => 'Team XYZ', 'lieu' => 'Exterieur'],
    ['date' => '20/02/2022', 'heure' => '19h00', 'adversaire' => 'Team ABC', 'lieu' => 'Domicile']
];

$joueursArray = array(
    '<div class="joueur">
        <div>
            <div class="en-tete-joueur">
                <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
            </div> 
            <h6> Licence [licence]</h6> 
        </div>
    </div>',
    '<div class="joueur">
        <div>
            <div class="en-tete-joueur">
                <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
            </div> 
            <h6> Licence [licence]</h6> 
        </div>
    </div>',
    '<div class="joueur">
        <div>
            <div class="en-tete-joueur">
                <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
            </div> 
            <h6> Licence [licence]</h6> 
        </div>
    </div>',
    '<div class="joueur">
        <div>
           <div class="en-tete-joueur">
                <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
            </div> 
            <h6> Licence [licence]</h6> 
        </div>
    </div>',
    '<div class="joueur">
        <div>
            <div class="en-tete-joueur">
                <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
            </div> 
            <h6> Licence [licence]</h6> 
        </div>
    </div>',
    '<div class="joueur">
        <div>
            <div class="en-tete-joueur">
                <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
            </div> 
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
        <form action="matchs.php" method="post">
            <table>
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Adversaire</th>
                    <th>Lieu</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Générer les lignes du tableau
                foreach ($matchs as $index => $match) {
                    echo '<tr class="clickable-row">';
                    echo '<form method="POST" action="process.php">';
                    echo '<input type="hidden" name="index" value="' . $index . '">';
                    echo '<td><button type="submit" class="invisible-btn"></button>' . $match['date'] . '</td>';
                    echo '<td><button type="submit" class="invisible-btn"></button>' . $match['heure'] . '</td>';
                    echo '<td><button type="submit" class="invisible-btn"></button>' . $match['adversaire'] . '</td>';
                    echo '<td><button type="submit" class="invisible-btn"></button>' . $match['lieu'] . '</td>';
                    echo '</form>';
                    echo '</tr>';
                }
                ?>
                </tbody>

            </table>
        </form>
    </div>

    <div class="btn-container">
        <button class="btn">Ajouter un match</button>
        <button class="btn">Annuler le match</button>
    </div>

    <h3>Joueurs participants :</h3>



    <div class="flexContainer">
        <?php echo $joueurs; ?>
    </div>
    <?php echo $index; ?>
</div>
</body>

</html>