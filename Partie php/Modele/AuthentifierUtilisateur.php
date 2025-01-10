<?php

namespace Modele;

use PDO;

class AuthentifierUtilisateur
{
    private PDO $conn;
    private Entraineur $entraineur;

    public function __construct()
    {

    }
    public function authenticate($resUser, $password): bool
    {

        if ($resUser && password_verify($password, $resUser['mot_de_passe'])) {
            // Authentification réussie
            return true;
        }
        return false;
    }
}