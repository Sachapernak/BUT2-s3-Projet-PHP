<?php
class MatchDAO { 

    // définition des attributs 
    private $pdo;
    
    // définition des méthodes 
    public function __construct() { 
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=ma_base', 'user', 'password');
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
                VALUES (STR_TO_DATE(:date_et_heure, "%d/%m/%Y %H:%i"), :adversaire, :lieu, :resultat)'
            );
            $requete->execute([
                ':date_et_heure' => $date_et_heure,
                ':adversaire' => $adversaire,
                ':lieu' => $lieu,
                ':resultat' => $resultat
            ]);
        } catch (Exception $e) {
            echo 'Erreur lors de l\'insertion : ' . $e->getMessage();
        }        
    }

    public function update($id_match, $date_et_heure, $adversaire, $lieu, $resultat) {
        try {
            $requete = $this->pdo->prepare('
                UPDATE Match_basket SET 
                    date_et_heure = STR_TO_DATE(:nvdate_et_heure, "%d/%m/%Y %H:%i"), 
                    adversaire = :nvadversaire, 
                    lieu = :nvlieu, 
                    resultat = :nvresultat 
                WHERE Id_Matchs = :id_match'
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

    public function delete($id_match) {
        try {
            $requete = $this->pdo->prepare('DELETE FROM Match_basket WHERE Id_Matchs = :id_match');
            $requete->execute([':id_match' => $id_match]);
        } catch (Exception $e) {
            echo 'Erreur lors de la suppression : ' . $e->getMessage();
        }
    }

    public function findById($id_match) {
        try {
            $match = null;
            $requete = $this->pdo->prepare('SELECT * FROM Match_basket WHERE Id_Matchs = :id_match');
            $requete->execute([':id_match' => $id_match]);
            $res = $requete->fetch(PDO::FETCH_ASSOC);
            if ($res) {
                $match = new Match_basket($res['Date_et_heure'], $res['Adversaire'], $res['Lieu'], $res['resultat']);
            }
            return $match;
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
    }

    public function findAll() : array {
        $matchs = [];
        try {
            $requete = $this->pdo->query('SELECT * FROM Match_basket');
            while ($res = $requete->fetch(PDO::FETCH_ASSOC)) {
                $matchs[] = new Match_basket($res['Date_et_heure'], $res['Adversaire'], $res['Lieu'], $res['resultat']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $matchs;
    }
}


?>