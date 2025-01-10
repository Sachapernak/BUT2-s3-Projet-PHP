<?php

require_once __DIR__ . '/../Modele/Database.php';

use Modele\Database;



$conn =  Database::getInstance();

$identifiant = "KTomato";
$nom = "Ketchup";
$prenom = "Tomato";
$mot_de_passe = "\$Bobby\$LePoissonRouge";


$sql = "INSERT INTO entraineur (identifiant, nom, prenom, mot_de_passe)
        VALUES (:identifiant, :nom, :prenom, :mot_de_passe)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':identifiant', $identifiant);
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':prenom', $prenom);
$hashed_password = password_hash($mot_de_passe, PASSWORD_BCRYPT);
$stmt->bindParam(':mot_de_passe', $hashed_password);
return $stmt->execute();

?>