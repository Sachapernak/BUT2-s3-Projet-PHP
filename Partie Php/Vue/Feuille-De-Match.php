<?php
require_once 'autoload.php';
require 'Verif-Auth.php';
use Controleur\ControleurPageFeuilleDeMatch;
use Controleur\ControleurPageMatchs;
use Controleur\ControleurPageJoueurs;

$controleurMatchs = new ControleurPageFeuilleDeMatch();
$controleurJoueurs = new ControleurPageJoueurs();

$idMatch = $_GET['idMatch'];

$listeJoueurs = $controleurMatchs->getJoueursActifs();
$joueursDejaSelectionnes = $controleurMatchs->getInfosParticipation($idMatch);

$joueursSelectionnes = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $selectionJoueur = $_POST['selectionJoueur'] ?? [];
    $positions = $_POST['position'] ?? [];
    $roles = $_POST['role'] ?? [];

    if (count($selectionJoueur) < 5) {
        echo "Vous devez sélectionner au moins 5 joueurs.";
    } else {
        foreach ($selectionJoueur as $licence => $valeur) {
            $position = $positions[$licence] ?? null;
            $role = $roles[$licence] ?? null;
            if ($position != null && $role != null) {
                $joueursSelectionnes[] = [
                    'licence' => $licence,
                    'position' => $position,
                    'role' => $role
                ];
            }
        }

        // Afficher les joueurs sélectionnés et leurs informations
        echo "Joueurs sélectionnés :<br>";
        foreach ($joueursSelectionnes as $joueur) {
            echo "Joueur avec la licence " . $joueur['licence'] . " est sélectionné.<br>";
            echo "Position: " . $joueur['position'] . ", Rôle: " . $joueur['role'] . "<br>";
        }
        echo count($joueursSelectionnes);
        // Si au moins 5 joueurs sont sélectionnés, rediriger
        if ($controleurMatchs->verifierTailleJoueursSelec($joueursSelectionnes) && $controleurMatchs->verifierPosition($joueursSelectionnes)) {
            $controleurMatchs->creerParticipation($joueursSelectionnes, $idMatch);
            header("Location: Matchs.php");
            exit;
        }
    }
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

    <?php include "barre-navigation.php" ?>
    <h2> Feuille de match </h2>

    <div class="main">
        <div class="table-container">
            <form action="" method="POST">
                <input type="hidden" name="action" value="selectionJoueur">
                <table>
                    <thead>
                        <tr>
                            <th>Licence</th>
                            <th>Nom</th>
                            <th>Taille</th>
                            <th>Poids</th>
                            <th>Commentaire</th>
                            <th>Note</th>
                            <th>Position</th>
                            <th>Role</th>
                            <th>Sélectionner</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Boucle pour afficher les joueurs
                        foreach ($listeJoueurs as $joueur) {
                            $n_licence = $joueur->getN_licence();

                            // Vérifiez si le joueur est sélectionné dans $joueursDejaSelectionnes
                            $index = array_search($n_licence, array_column($joueursDejaSelectionnes, 'n_licence'));

                            // Si le joueur est trouvé dans la liste des joueurs déjà sélectionnés
                            if ($index !== false) {
                                $positionPreRemplie = $joueursDejaSelectionnes[$index]['position'];
                                echo positionPreRemplie;
                                $rolePreRemplie = $joueursDejaSelectionnes[$index]['role'];
                                $estSelectionne = true;
                            } else {
                                // Si le joueur n'est pas trouvé, valeurs par défaut
                                $positionPreRemplie = 'nique';
                                $rolePreRemplie = 'tarace';
                                $estSelectionne = false;
                            }

                            // Affichage des informations du joueur
                            echo '<tr>';
                            echo '<td>' . $joueur->getN_licence() . '</td>';
                            echo '<td>' . $joueur->getNom() . " " . $joueur->getPrenom() . '</td>';
                            echo '<td>' . $joueur->getTaille() . ' cm </td>';
                            echo '<td>' . $joueur->getPoids() . ' kg </td>';
                            echo '<td>' . $controleurMatchs->getCommentairesJoueur($n_licence) . '</td>';
                            echo '<td>' . $controleurJoueurs->getNoteMoyenneJoueur($n_licence) . '</td>';

                            // Pré-remplissage du champ Position
                            echo '<td> 
                                    <select id="position' . $n_licence . '" name="position[' . $n_licence . ']">
                                        <option value="">-- Sélectionnez une position --</option>
                                        <option value="Meneur" ' . ($positionPreRemplie == 'Meneur' ? 'selected' : '') . '>Meneur</option>
                                        <option value="Ailier" ' . ($positionPreRemplie == 'Ailier' ? 'selected' : '') . '>Ailier</option>
                                        <option value="Pivot" ' . ($positionPreRemplie == 'Pivot' ? 'selected' : '') . '>Pivot</option>
                                    </select>         
                                  </td>';

                            // Pré-remplissage du champ Rôle
                            echo '<td> 
                                    <select id="role_' . $n_licence . '" name="role[' . $n_licence . ']">
                                        <option value="0" ' . ($rolePreRemplie == '0' ? 'selected' : '') . '>Titulaire</option>
                                        <option value="1" ' . ($rolePreRemplie == '1' ? 'selected' : '') . '>Remplaçant</option>
                                    </select>         
                                  </td>';

                            // Pré-remplissage de la case à cocher (si le joueur est sélectionné)
                            echo '<td> 
                                    <input type="checkbox" name="selectionJoueur[' . $n_licence . ']" value="1" ' . ($estSelectionne ? 'checked' : '') . '> 
                                  </td>';
                            echo '</tr>';
                        }


                        ?>
                    </tbody>
                </table>
                <div class="form-buttons">
                    <input type="hidden" name="action" value="valider">
                    <button type="submit" class="btn btn-valider">Valider</button>
                    <button type="button" class="btn btn-annuler"
                        onclick="window.location.href='Matchs.php'">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>