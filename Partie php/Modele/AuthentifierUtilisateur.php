<?php

namespace Modele;

use DAO\DaoEntraineur;
use PDO;

class AuthentifierUtilisateur
{
    private PDO $conn;
    private Entraineur $entraineur;

    public function __construct()
    {

    }
    public function authenticate($login, $password): bool
    {
        $DaoE = new DaoEntraineur();

        $hashed_bd_pwd = $DaoE->getHashedpwd($login);

        file_put_contents('php://stderr', print_r($hashed_bd_pwd. " ".$password, TRUE));

        if ($hashed_bd_pwd && password_verify($password, $hashed_bd_pwd)) {
            file_put_contents('php://stderr', print_r("za marche", TRUE));
            return true;
        }
        file_put_contents('php://stderr', print_r("za marche pas", TRUE));

        $hashed_bd_pwd && password_verify($password, password_hash($password, PASSWORD_BCRYPT));
        return false;

    }
}