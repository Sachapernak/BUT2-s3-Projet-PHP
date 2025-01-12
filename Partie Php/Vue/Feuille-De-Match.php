<?php
require_once 'autoload.php';
use Controleur\ControleurPageFeuilleDeMatch;
use Controleur\ControleurPageJoueurs;

session_start();

$controleurMatchs = new ControleurPageFeuilleDeMatch();
$controleurJoueurs = new ControleurPageJoueurs();

if (!isset($_SESSION['joueurs_selectionnes'])) {
    $_SESSION['joueurs_selectionnes'] = [];
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n_licence = $_POST['n_licence'];

    $position = isset($_POST['position'][$n_licence]) ? $_POST['position'][$n_licence] : null;
    $role = isset($_POST['role'][$n_licence]) ? $_POST['role'][$n_licence] : null;
    $selected = isset($_POST['selectionJoueur']);

    if ($selected) {
        $_SESSION['joueurs_selectionnes'][$n_licence] = [
            'position' => $position,
            'role' => $role,
        ];
    } else {
        unset($_SESSION['joueurs_selectionnes'][$n_licence]);
    }
}

// Liste des joueurs
$listeJoueurs = $controleurMatchs->getJoueursActifs();
$joueurs = "";

foreach ($listeJoueurs as $joueur) {
    $nom = $joueur->getNom();
    $prenom = $joueur->getPrenom();
    $n_licence = $joueur->getN_licence();
    $statut = $joueur->getIntituleStatut();
    $noteMoyenne = $controleurJoueurs->afficherEtoiles($n_licence);

    // Vérifier si le joueur est sélectionné
    $checked = isset($_SESSION['joueurs_selectionnes'][$n_licence]) ? 'checked' : '';

    $joueurs .= '
        <div class="joueur">
            <div class="attributs">
                <h5>' . $nom . ' ' . $prenom . ' N° de licence : ' . $n_licence . '</h5>
            </div>

            <!-- Formulaire de position et rôle -->
            <form action="Feuille-De-Match.php" method="POST" id="formulaireParticipation">
                <div class="participation-item">
                    <label for="position_' . $n_licence . '">Position :</label>
                    <select id="position_' . $n_licence . '" name="position[' . $n_licence . ']">
                        <option value="Meneur" ' . (isset($_SESSION['joueurs_selectionnes'][$n_licence]) && $_SESSION['joueurs_selectionnes'][$n_licence]['position'] === 'Meneur' ? 'selected' : '') . '>Meneur</option>
                        <option value="Ailier" ' . (isset($_SESSION['joueurs_selectionnes'][$n_licence]) && $_SESSION['joueurs_selectionnes'][$n_licence]['position'] === 'Ailier' ? 'selected' : '') . '>Ailier</option>
                        <option value="Pivot" ' . (isset($_SESSION['joueurs_selectionnes'][$n_licence]) && $_SESSION['joueurs_selectionnes'][$n_licence]['position'] === 'Pivot' ? 'selected' : '') . '>Pivot</option>
                    </select>
                </div>

                <div class="participation-item">
                    <label for="role_' . $n_licence . '">Rôle :</label>
                    <select id="role_' . $n_licence . '" name="role[' . $n_licence . ']">
                        <option value="False" ' . (isset($_SESSION['joueurs_selectionnes'][$n_licence]) && $_SESSION['joueurs_selectionnes'][$n_licence]['role'] === 'False' ? 'selected' : '') . '>Titulaire</option>
                        <option value="True" ' . (isset($_SESSION['joueurs_selectionnes'][$n_licence]) && $_SESSION['joueurs_selectionnes'][$n_licence]['role'] === 'True' ? 'selected' : '') . '>Remplaçant</option>
                    </select>
                </div>

                <input type="hidden" name="n_licence" value="' . $n_licence . '">
                
                <!-- Case à cocher -->
                <div class="checkbox">
                    <input 
                        type="checkbox" 
                        name="selectionJoueur" 
                        value="1" 
                        onchange="this.form.submit()"
                        ' . $checked . '>
                </div>
            </form>
        </div>';
}
?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/Feuille-De-Match-Style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Handi-Team Manager</title>
</head>

<body>

    <?php include "barre-navigation.html" ?>
    <h2> Feuille de match </h2>

    <div class="main">


        <div class="infos-match-container">
            <h3>Le match</h3>
            <form action="Feuille-De-Match.php" method="POST">
                <div class="match-item">
                    <label for="date-et-heure">Date et heure </label>
                    <input type="date" id="date" name="date" required> 
                    <input type="time" id="heure" name="heure" required>
                </div>

                <div class="match-item">
                    <label for="adversaire">Adversaire :</label>
                    <input type="text" id="adversaire" name="adversaire" placeholder="Adversaire" required>

                    <label for="lieu">Lieu :</label>
                    <select id="lieu" name="lieu">
                        <option value="dom">A domicile</option>
                        <option value="ext">Extérieur</option>
                    </select>
                </div>


                


                <div class="form-buttons">
                    <button type="submit" class="btn btn-valider">Valider</button>
                    <button type="button" class="btn btn-annuler"
                        onclick="window.location.href='Matchs.php'">Annuler</button>
                </div>
            </form>
        </div>

        <div class="infos-joueur">
            <div class="liste-joueurs">
                <?php echo $joueurs; ?>
            </div>
            
        </div>

        


    </div>
</body>

</html>