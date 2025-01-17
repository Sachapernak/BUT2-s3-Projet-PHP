<?php 

namespace Vue;

session_start();
$auth = $_SESSION['authentifie'] ?? false;
if ($auth != true) {
    header('Location: page-connexion.php');
    exit;
}
?>