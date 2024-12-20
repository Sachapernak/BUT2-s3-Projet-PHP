<?php

namespace DAO;

require_once __DIR__ . '/../Modele/Database.php';

use Modele\Database;
use Modele\Entraineur;


class DaoEntraineur
{
    public function getById($identifiant){

        $sql = "SELECT * FROM Entraineur WHERE identifiant = :identifiant";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->execute();

        return $this->createInstance($stmt->fetch());
    }

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