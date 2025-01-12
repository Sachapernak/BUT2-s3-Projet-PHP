<?php

namespace DAO;
use Modele\Database;
use Modele\MatchBasket;
use PDO;
class MatchDAO { 

    // définition des attributs 
    private $pdo;
    
    // définition des méthodes 
    public function __construct() { 
        try {
            $this->pdo = Database::getInstance();;
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $e) {
            die('Erreur de connexion à la base de données.');
        }
    } 
    
    public function insert($date_et_heure, $adversaire, $lieu, $resultat) {
        try {
            $requete = $this->pdo->prepare('
                INSERT INTO Match_basket (date_et_heure, adversaire, lieu, resultat)
                VALUES :date_et_heure, :adversaire, :lieu, :resultat)'
            );
            $requete->execute([
                ':date_et_heure' => $date_et_heure,
                ':adversaire' => $adversaire,
                ':lieu' => $lieu,
                ':resultat' => $resultat
            ]);

            // Récupérer l'ID généré
            $id_match = $this->pdo->lastInsertId();
            return $id_match;
        } catch (Exception $e) {
            echo 'Erreur lors de l\'insertion : ' . $e->getMessage();
        }        
    }

    public function update($id_match, $date_et_heure, $adversaire, $lieu, $resultat) {
        try {
            $requete = $this->pdo->prepare('
                UPDATE Match_basket SET 
                    date_et_heure = :nvdate_et_heure, 
                    adversaire = :nvadversaire, 
                    lieu = :nvlieu, 
                    resultat = :nvresultat 
                WHERE id_match = :id_match'
            );
            $requete->execute([
                ':nvdate_et_heure' => $date_et_heure,
                ':nvadversaire' => $adversaire,
                ':nvlieu' => $lieu,
                ':nvresultat' => $resultat,
                ':id_match' => $id_match
            ]);
        } catch (Exception $e) {
            echo 'Erreur lors de la mise à jour : ' . $e->getMessage();
        }
    }

    public function delete($id_match): bool {
        $res =false;
        try {

            $requeteSupprJouer = $this->pdo->prepare('DELETE FROM Jouer WHERE id_match = :id_match');
            $requeteSupprJouer->execute([':id_match' => $id_match]);

            $requete = $this->pdo->prepare('DELETE FROM Match_basket WHERE id_match = :id_match');
            $requete->execute([':id_match' => $id_match]);

            $res = $requete->rowCount() > 0;

        } catch (Exception $e) {
            echo 'Erreur lors de la suppression : ' . $e->getMessage();
        }
        return $res;
    }

    public function findById($id_match) {
        $match = null;
        try {
            $requete = $this->pdo->prepare('SELECT * FROM Match_basket WHERE id_match = :id_match');
            $requete->execute([':id_match' => $id_match]);
            $res = $requete->fetch();
            if ($res) {
                $match = new Match_basket($res['id_match'], $res['date_et_heure'], $res['adversaire'], $res['lieu'], $res['resultat']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $match;
    }

    public function findComingMatch($dateMatch) {
        $matchs = [];
        try {
            $requete = $this->pdo->prepare('SELECT * FROM Match_basket where CAST(date_et_heure AS DATE) > :dateMatch');
            $requete->execute([':dateMatch' => $dateMatch]);
            while ($res = $requete->fetch()) {
                $matchs[] = new MatchBasket($res['id_match'], $res['date_et_heure'], $res['adversaire'], $res['lieu'], $res['resultat']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $matchs;
    }

    public function findOldMatch($dateMatch) {
        $matchs = [];
        try {
            $requete = $this->pdo->prepare('SELECT * FROM Match_basket where CAST(date_et_heure AS DATE) < :dateMatch');
            $requete->execute([':dateMatch' => $dateMatch]);
            while ($res = $requete->fetch()) {
                $matchs[] = new MatchBasket($res['id_match'], $res['date_et_heure'], $res['adversaire'], $res['lieu'], $res['resultat']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $matchs;
    }
    

    public function findAll() : array {
        $matchs = [];
        try {
            $requete = $this->pdo->query('SELECT * FROM Match_basket');
            while ($res = $requete->fetch()) {
                $matchs[] = new MatchBasket($res['id_match'], $res['date_et_heure'], $res['adversaire'], $res['lieu'], $res['resultat']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $matchs;
    }

    public function getTotalVictoires() : int {
        $total = -1; 
        try {
            $requete = $this->pdo->prepare("SELECT COUNT(*) AS total_victoires FROM Match_basket WHERE resultat = 'V'");
            $requete->execute();
            $res = $requete->fetch(); 
            
            if ($res) {
                return (int) $res['total_victoires'];
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $total;
    }

    public function getTotalDefaites() : int {
        $total = -1; 
        try {
            $requete = $this->pdo->prepare("SELECT COUNT(*) AS total_defaites FROM Match_basket WHERE resultat = 'D'");
            $requete->execute();
            $res = $requete->fetch(); 
            
            if ($res) {
                return (int) $res['total_defaites'];
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $total;
    }

    public function getTotalNuls() : int {
        $total = -1; 
        try {
            $requete = $this->pdo->prepare("SELECT COUNT(*) AS total_nuls FROM Match_basket WHERE resultat = 'N'");
            $requete->execute();
            $res = $requete->fetch(); 
            
            if ($res) {
                return (int) $res['total_nuls'];
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $total;
    }

    public function getTotalMatchs() : int {
        $total = -1; 
        try {
            $requete = $this->pdo->prepare("SELECT COUNT(*) AS total FROM Match_basket");
            $requete->execute();
            $res = $requete->fetch(); 
            
            if ($res) {
                return (int) $res['total'];
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $total;
    }


    

}


?>