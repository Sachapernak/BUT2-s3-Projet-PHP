<?php
require_once 'autoload.php';
use Controleur\RechercherUnJoueur;
use Controleur\ControleurPageConsulterInfosJoueur;
use DAO\JoueurDAO;

if (isset($_GET['nLicence'])) {
    $n_licence = $_GET['nLicence'];
    $joueurDAO = new JoueurDAO();
    $rechercherUnJoueur = new RechercherUnJoueur($joueurDAO, $n_licence);
    $joueur = $rechercherUnJoueur->executer();

    if (!$joueur) {
        echo "Joueur introuvable.";
        exit;
    }
} else {
    echo "Aucun joueur sélectionné.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controleur = new ControleurPageConsulterInfosJoueur();

    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'mettreAJourJoueur':
            $joueur = $controleur->mettreAJourJoueur();
            break;

        case 'ajouterCommentaire':
            $controleur->ajouterCommentaire();
            break;

        default:
            echo "Action non reconnue.";
            break;
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Consulter-Infos-Joueur-Style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Détails du Joueur</title>
</head>

<body>
    <?php include "barre-navigation.html" ?>

    <div id="retour">
        <a href="Joueurs.php"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i></a>
    </div>

    <div class="main">

        <label for="toggle-checkbox" id="toggle-modif"><i class="fa-solid fa-pen-to-square"
                style="color: #ffffff;"></i></label>
        <input type="checkbox" id="toggle-checkbox">

        <div id="extra-fields">
            <form action="" method="POST">
                <input type="hidden" name="action" value="mettreAJourJoueur">
                <label for="nom" class="labelModif">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?php echo $joueur->getNom() ?>">

                <label for="prenom" class="labelModif">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $joueur->getPrenom() ?>">

                <label for="statut" class="labelModif">Statut :</label>
                <select id="statut" name="statut" value="<?php echo $joueur->getStatut() ?>">
                    <option value="Act">Actif</option>
                    <option value="Abs">Absent</option>
                    <option value="Ble">Blessé</option>
                    <option value="Sus">Suspendu</option>
                </select>

                <label for="date_naissance" class="labelModif">Date de naissance :</label>
                <input type="date" id="date_naissance" name="date_naissance"
                    value="<?php echo $joueur->getDate_de_naissance(); ?>">

                <label for="taille" class="labelModif">Taille (cm) :</label>
                <input type="number" id="taille" name="taille" value="<?php echo $joueur->getTaille() ?>" min="0">

                <label for="poids" class="labelModif">Poids (kg) :</label>
                <input type="number" id="poids" name="poids" value="<?php echo $joueur->getPoids() ?>" min="0">

                <div class="form-buttons">
                    <button type="submit" class="btn btn-valider">Valider</button>
                </div>
            </form>
        </div>

        <div class="infos-container">

            <div>
                <h2 class="licence">N° de licence : <?php echo $joueur->getN_licence() ?></h2>
            </div>

            <div class="info-item">
                <label class="nom">Nom : </label>
                <span class="nom"><?php echo $joueur->getNom() ?></span>
            </div>

            <div class="info-item">
                <label class="prenom">Prénom : </label>
                <span class="prenom"><?php echo $joueur->getPrenom() ?></span>
            </div>

            <div class="info-item">
                <label class="statut">Statut : </label>
                <span class="statut"><?php echo $joueur->getIntituleStatut() ?></span>
            </div>

            <div class="info-item">
                <label class="date_naissance">Date de naissance : </label>
                <span class="date_naissance"><?php echo $joueur->getDate_de_naissance() ?></span>
            </div>

            <div class="info-item">
                <label class="taille">Taille (cm) : </label>
                <span class="taille"><?php echo $joueur->getTaille() ?></span>
            </div>

            <div class="info-item">
                <label class="poids">Poids (kg) : </label>
                <span class="poids"><?php echo $joueur->getPoids() ?></span>
            </div>

            <div class="commentaires-section">
                <h2>Commentaires</h2>
                <table class="commentaires-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $controleur = new ControleurPageConsulterInfosJoueur();
                        $commentaires = $controleur->recupererCommentaires();
                        if ($commentaires):
                            foreach ($commentaires as $commentaire): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($commentaire->getDate()); ?></td>
                                    <td><?php echo htmlspecialchars($commentaire->getCommentaire()); ?></td>
                                </tr>
                            <?php endforeach;
                        else: ?>
                            <tr>
                                <td colspan="2">Aucun commentaire pour ce joueur.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Formulaire pour ajouter un commentaire -->
                <form action="" method="POST" class="ajouter-commentaire-form">
                    <input type="hidden" name="action" value="ajouterCommentaire">
                    <label for="commentaire" class="label-commentaire">Ajouter un commentaire :</label>
                    <textarea id="commentaire" name="commentaire" rows="3" required></textarea>
                    <button type="submit" class="btn btn-ajouter">Ajouter</button>
                </form>
            </div>


        </div>
    </div>
</body>

</html>