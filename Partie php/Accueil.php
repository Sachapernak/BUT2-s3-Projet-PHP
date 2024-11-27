<?php
$name = "NameNotFound";
$surname = "SurnameNotFound";
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
    <header class="main-header">
        <div class="left-div">
            <div class="title-container">
                <h1>🏀 Handi-Team Manager Pro™</h1>
            </div>
        </div>
        <div class="right-div">
            <a href="" target="_blank">
                <span>Compte</span>
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
            <h2>Bienvenue sur Handi-Team Manager</h2>
            <h3><?php echo($name . " " . $surname) ?></h3>
        </div>
    </div>
</body>
</html>
