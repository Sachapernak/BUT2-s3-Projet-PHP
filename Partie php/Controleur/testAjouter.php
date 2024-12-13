<?php
require_once 'CreerUnJoueur.php'; // Inclure votre classe PHP
require_once 'Joueur.php';        // Inclure la classe Joueur si elle est séparée

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=handi_basket_bd', 'appliHandiTeam', 'TroisCacahuetesOrangesSur@UnCailloux$');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données du formulaire
    $n_licence = $_POST['n_licence'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_de_naissance = $_POST['date_de_naissance'];
    $taille = $_POST['taille'];
    $poids = $_POST['poids'];
    $statut = $_POST['statut'];

    // Créer un joueur
    $createur = new CreerUnJoueur($pdo, $n_licence, $nom, $prenom, $date_de_naissance, $taille, $poids, $statut);
    $joueur = $createur->executer();

    // Afficher le résultat
    echo "<h1>Joueur créé avec succès</h1>";
    echo "<p>Nom : " . htmlspecialchars($joueur->getNom()) . "</p>";
    echo "<p>Prénom : " . htmlspecialchars($joueur->getPrenom()) . "</p>";
    echo "<p>Numéro de licence : " . htmlspecialchars($joueur->getNLicence()) . "</p>";
} catch (Exception $e) {
    echo "<h1>Erreur</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
