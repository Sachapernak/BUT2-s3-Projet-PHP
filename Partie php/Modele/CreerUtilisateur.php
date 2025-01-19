<?php

require_once __DIR__ . '/../Modele/Database.php';

use Modele\Database;



$conn =  Database::getInstance();

$identifiant = "KTomato";
$nom = "Ketchup";
$prenom = "Tomato";
$mot_de_passe = "azerty";


$sql = "INSERT INTO entraineur (identifiant, nom, prenom, mot_de_passe)
        VALUES (:identifiant, :nom, :prenom, :mot_de_passe)";

$conn->beginTransaction();  // début d'une transaction
$stmt = $conn->prepare($sql);
$stmt->bindParam(':identifiant', $identifiant);
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':prenom', $prenom);
$hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);
$stmt->bindParam(':mot_de_passe', $hashed_password);
$stmt->execute();
$conn->commit();

?> 