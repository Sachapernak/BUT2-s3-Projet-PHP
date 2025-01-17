<?php

namespace DAO;

require_once __DIR__ . '/../Modele/Database.php';

use http\Encoding\Stream;
use Modele\Database;
use Modele\Entraineur;


class DaoEntraineur
{
    //Méthode pour récupérer un entraîneur à partir de son identifiant
    public function getById($identifiant) : ? Entraineur
    {

        $sql = "SELECT * FROM entraineur WHERE identifiant = :identifiant";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->execute();

        return $this->createInstance($stmt->fetch());
    }

     // Méthode pour récupérer le mot de passe haché d'un entraîneur
    public function getHashedpwd($identifiant) : String {

        $sql = "SELECT mot_de_passe FROM entraineur WHERE identifiant = :identifiant";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->execute();

        $res = $stmt->fetch();

        if (!$res) {
            return "";
        }
        return $res['mot_de_passe'];
    }

    // Méthode pour créer une instance de Entraineur à partir d'un tableau de résultats
    public function createInstance($res) : ?Entraineur
    {
        if (!$res) {
            return null;
        }
        $id = $res['identifiant'];
        $nom = $res['nom'];
        $prenom = $res['prenom'];

        return new Entraineur($id, $nom, $prenom);
    }
}