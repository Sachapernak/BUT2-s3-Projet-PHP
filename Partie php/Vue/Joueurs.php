<?php

$joueursArray = array(
                '<div class="joueur">
<div>
    <h5>[Nom] [Prenom]</h5>
    <h6> N° de licence : </h6>
    <h6> Statut : </h6>
    <span>★★★☆☆</span>
</div>
</div>',
'<div class="joueur">
    <div>
        <h5>[Nom] [Prenom]</h5>
        <h6> N° de licence : </h6>
        <h6> Statut : </h6>
        <span>★★★☆☆</span>
    </div>
</div>',
'<div class="joueur">
    <div>
        <h5>[Nom] [Prenom]</h5>
        <h6> N° de licence : </h6>
        <h6> Statut : </h6>
        <span>★★★☆☆</span>
    </div>
</div>',
'<div class="joueur">
    <div>
        <h5>[Nom] [Prenom]</h5>
        <h6> N° de licence : </h6>
        <h6> Statut : </h6>
        <span>★★★☆☆</span>
    </div>
</div>',
'<div class="joueur">
    <div>
        <h5>[Nom] [Prenom]</h5>
        <h6> N° de licence : </h6>
        <h6> Statut : </h6>
        <span>★★★☆☆</span>
    </div>
</div>',
'<div class="joueur">
    <div>
        <h5>[Nom] [Prenom]</h5>
        <h6> N° de licence : </h6>
        <h6> Statut : </h6>
        <span>★★★☆☆</span>
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
    <link rel="stylesheet" href="CSS/Joueurs-Style.css">
    <title>Handi-Team Manager</title>
</head>
<body>

<?php include "barre-navigation.html" ?>


    <!-- Page content -->
    <div class="main">
        <h2>Vos joueurs</h2>

        <div class="recherche">
            <input type="text" id="search-bar" name="searchbar" placeholder="Rechercher un joueur...">
            <button id="search-button">🔍</button>
        </div>

        <div class="flexContainer">
            <?php echo $joueurs;?>
        </div>


    </div>
</div>
</body>
</html>
