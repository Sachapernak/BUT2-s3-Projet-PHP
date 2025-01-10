<?php
// ControleurConnexion.php

namespace Controleur;

require_once 'autoload.php';
use DAO\DaoEntraineur;
use Modele\AuthentifierUtilisateur;

class ControleurConnexion
{
    /**
     * Traite la demande de connexion.
     *
     * @param string $login    Identifiant (nom d'utilisateur).
     * @param string $password Mot de passe en clair.
     */
    public function processLogin(string $login, string $password): void
    {


        $authentifier = new AuthentifierUtilisateur();

        if ($authentifier->authenticate($login, $password)) {
            // Authentification réussie : créer et initialiser la session
            $_SESSION['authentifie'] = true;
            $_SESSION['idco'] = $login;

            header("Location: Accueil.php");

            exit;
        } else {

            $this->redirectWithError("Identifiant ou mot de passe incorrect.");
        }
    }

    /**
     * Redirige l'utilisateur vers la page de connexion avec un message d'erreur.
     *
     * @param string $messageErreur Message d'erreur à afficher.
     */
    private function redirectWithError(string $messageErreur): void
    {
        // On place le message d'erreur dans la session ou dans un paramètre GET
        $_SESSION['messageErreur'] = $messageErreur;
        header("Location: page-connexion.php");
        exit;
    }

    public function getMessageErreur(): string
    {

        return $_SESSION['messageErreur'] ?? " ";
    }
}
