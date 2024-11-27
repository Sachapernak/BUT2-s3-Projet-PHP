<?php
$name = "Didier";
$lastname = "Bernard";
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./CSS/Accueil-Style.css">
    <title>Handi-Team Manager</title>
</head>
<body>

    <!-- Header -->
    <header class="main-header">
        <div class="left-div">
            <div class="title-container">
                <h1>🏀<span id="titleText">Handi-Team</span> Manager<span id="titleText"> Pro™</span></h1>
            </div>
        </div>
        <div class="right-div">
            <a href="" target="_blank">
                <span id="compteButton">Compte</span>
            </a><a href="" target="_blank">
                <img class="icon" src="./Images/account-avatar.svg" alt="Compte">
            </a>
        </div>
    </header>

    <!-- Side navigation -->
    <div class="side-div">
        <div class="sidenav">
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a>
        </div>

        <!-- Page content -->
        <div class="main">
            <h2>Bienvenue sur Handi-Team Manager,</h2>
            <h3><?php echo($name . " " . $lastname) ?></h3>

            <!-- Matchs -->
            <div id="MatchRecentTitre"><h3>Matchs récents :</h3></div>
            <div class="flexContainer">
                <div class="match">
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
                </div>

                <div class="match">
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
                </div>
            </div>

            <div id="MatchRecentTitre"><h3>Joueurs disponibles :</h3></div>
            <div class="flexContainer">
                <div class="joueur">
                    <div>
                        <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                    </div>
                </div>
                <div class="joueur">
                    <div>
                        <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                    </div>
                </div>
                <div class="joueur">
                    <div>
                        <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                    </div>
                </div>
                <div class="joueur">
                    <div>
                        <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                    </div>
                </div>
                <div class="joueur">
                    <div>
                        <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                    </div>
                </div>
                <div class="joueur">
                    <div>
                        <h5>[Nom] [Prenom]</h5> <span>★★★</span><span>☆☆</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
