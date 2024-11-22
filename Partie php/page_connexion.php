<?php
session_start();

// Définition du login et du mot de passe en dur

    $server = '';
	$db = '';

try {
        $linkpdo = new PDO("mysql:host=$server;dbname=$db", $_POST['login'], );
    }
        catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

// Gestion du formulaire de connexion
if (isset($_POST['login']) && isset($_POST['password'])) {
    if ($_POST['login'] === $login &&  password_hash($_POST['password'], 'BobbyshLePoissonROUGE')) {
        $_SESSION['auth'] = true;
        header('Location: page_connexion.php');
        exit();
    } else {
        echo '<p style="color:red;">Login ou mot de passe incorrect.</p>';
    }
}

// Vérification de l'authentification
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    echo '<p>Vous êtes connecté.</p>';
} else {
    // Formulaire de connexion
    include('formulaire_connexion.php');
}
?>
