<?php

namespace DAO;
use Exception;
use Modele\Database;
use Modele\MatchBasket;
use PDO;
class MatchDAO { 

    // définition des attributs 
    private $pdo;
    
    // définition des méthodes 
    public function __construct() { 
        try {
            $this->pdo = Database::getInstance();
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $e) {
            die('Erreur de connexion à la base de données.');
        }
    } 
    
    // Méthode pour insérer un match
    public function insert($date_et_heure, $adversaire, $lieu, $resultat) {
        try {
            $requete = $this->pdo->prepare('
                INSERT INTO match_basket (date_et_heure, adversaire, lieu, resultat)
                VALUES (:date_et_heure, :adversaire, :lieu, :resultat)'
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
        return null;
    }

    // Méthode pour mettre à jour un match
    public function update($id_match, $date_et_heure, $adversaire, $lieu, $resultat) {
        try {
            $requete = $this->pdo->prepare('
                UPDATE match_basket SET 
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

    // Méthode pour supprimer un match à partir de son identifiant 
    public function delete($id_match): bool {
        $res =false;
        try {

            $requeteSupprJouer = $this->pdo->prepare('DELETE FROM jouer WHERE id_match = :id_match');
            $requeteSupprJouer->execute([':id_match' => $id_match]);

            $requete = $this->pdo->prepare('DELETE FROM match_basket WHERE id_match = :id_match');
            $requete->execute([':id_match' => $id_match]);

            $res = $requete->rowCount() > 0;

        } catch (Exception $e) {
            echo 'Erreur lors de la suppression : ' . $e->getMessage();
        }
        return $res;
    }

    //Méthode pour récupérer un match à partir de son identifiant
    public function findById($id_match): ?MatchBasket {
        $match = null;
        try {
            $requete = $this->pdo->prepare('SELECT * FROM match_basket WHERE id_match = :id_match');
            $requete->execute([':id_match' => $id_match]);
            $res = $requete->fetch();
            if ($res) {
                $match = new MatchBasket($res['date_et_heure'], $res['adversaire'], $res['lieu'], $res['id_match'], $res['resultat']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $match;
    }

    //Méthode pour trouver les matchs à venir
    public function findComingMatch(): array {
        $matchs = [];
        try {
            $requete = $this->pdo->prepare('SELECT * FROM match_basket where date_et_heure >= SYSDATE() ORDER BY date_et_heure DESC');
            $requete->execute();
            while ($res = $requete->fetch()) {
                $matchs[] = new MatchBasket($res['date_et_heure'], $res['adversaire'], $res['lieu'], $res['id_match'], $res['resultat']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $matchs;
    }

    //Méthode pour trouver les matchs passés
    public function findOldMatch(): array {
        $matchs = [];
        try {
            $requete = $this->pdo->prepare('SELECT * FROM match_basket where date_et_heure < SYSDATE() ORDER BY date_et_heure DESC');
            $requete->execute();
            while ($res = $requete->fetch()) {
                $matchs[] = new MatchBasket($res['date_et_heure'], $res['adversaire'], $res['lieu'], $res['id_match'], $res['resultat']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $matchs;
    }
    
    //Méthode pour récupérer tous les matchs
    public function findAll() : array {
        $matchs = [];
        try {
            $requete = $this->pdo->query('SELECT * FROM match_basket');
            while ($res = $requete->fetch()) {
                $matchs[] = new MatchBasket($res['date_et_heure'], $res['adversaire'], $res['lieu'], $res['id_match'], $res['resultat']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $matchs;
    }

    //Méthode pour récupérer le nombre total de victoires
    public function getTotalVictoires() : int {
        $total = -1; 
        try {
            $requete = $this->pdo->prepare("SELECT COUNT(*) AS total_victoires FROM match_basket WHERE resultat = 'V'");
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

    //Méthode pour récupérer le nombre total de défaites
    public function getTotalDefaites() : int {
        $total = -1; 
        try {
            $requete = $this->pdo->prepare("SELECT COUNT(*) AS total_defaites FROM match_basket WHERE resultat = 'D'");
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

    //Méthode pour récupérer le nombre total de matchs nuls
    public function getTotalNuls() : int {
        $total = -1; 
        try {
            $requete = $this->pdo->prepare("SELECT COUNT(*) AS total_nuls FROM match_basket WHERE resultat = 'N'");
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

    //Méthode pour récupérer le nombre total de matchs
    public function getTotalMatchs() : int {
        $total = -1; 
        try {
            $requete = $this->pdo->prepare("SELECT COUNT(*) AS total FROM match_basket where date_et_heure < SYSDATE() ORDER BY date_et_heure DESC");

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