<?php

namespace DAO;
use Modele\Commentaire;
use Modele\Database;
use PDO;
class CommentaireDAO {

    // Définition des attributs
    private $pdo;

    // Définition des méthodes
    public function __construct() {
        try {
            $this->pdo = Database::getInstance();
        } catch (Exception $e) {
            die('Erreur de connexion à la BD : ' . $e->getMessage());
        }
    }

    // Méthode pour insérer un commentaire
    public function insert($n_licence, $date_Com, $commentaire) {
        try {
            $requete = $this->pdo->prepare('
                INSERT INTO commentaire (n_licence, date_Com, commentaire)
                VALUES (:n_licence, :date_Com, :commentaire)'
            );
            $requete->execute([
                ':n_licence' => $n_licence,
                ':date_Com' => $date_Com,
                ':commentaire' => $commentaire
            ]);
        } catch (Exception $e) {
            echo 'Erreur lors de l\'insertion : ' . $e->getMessage();
        }
    }

    // Méthode pour mettre à jour un commentaire
    public function update($n_licence, $date_Com, $commentaire) {
        try {
            $requete = $this->pdo->prepare('
                UPDATE commentaire 
                SET commentaire = :commentaire 
                WHERE n_licence = :n_licence AND date_Com = :date_Com'
            );
            $requete->execute([
                ':n_licence' => $n_licence,
                ':date_Com' => $date_Com,
                ':commentaire' => $commentaire
            ]);
        } catch (Exception $e) {
            echo 'Erreur lors de la mise à jour : ' . $e->getMessage();
        }
    }

    // Méthode pour supprimer un commentaire
    public function delete($n_licence, $date_Com) {
        $res = false;
        try {
            $requete = $this->pdo->prepare('
                DELETE FROM commentaire 
                WHERE n_licence = :n_licence AND date_Com = :date_Com'
            );
            $requete->execute([
                ':n_licence' => $n_licence,
                ':date_Com' => $date_Com
            ]);
            $res = $requete->rowCount() > 0; // Retourne true si une ligne a été supprimée
        } catch (Exception $e) {
            echo 'Erreur lors de la suppression : ' . $e->getMessage();
        }
        return $res;
    }

    // Méthode pour récupérer un commentaire par licence et date
    public function findById($n_licence, $date_Com) {
        $commentaire = null;
        try {
            $requete = $this->pdo->prepare('
                SELECT * FROM commentaire 
                WHERE n_licence = :n_licence AND date_Com = :date_Com'
            );
            $requete->execute([
                ':n_licence' => $n_licence,
                ':date_Com' => $date_Com
            ]);
            $res = $requete->fetch(PDO::FETCH_ASSOC);
            if ($res) {
                $commentaire = new Commentaire($res['n_licence'], $res['date_Com'], $res['commentaire']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $commentaire;
    }

    // Méthode pour récupérer tous les commentaires d'un joueur
    public function findAllByJoueur($n_licence) {
        $commentaires = [];
        try {
            $requete = $this->pdo->prepare('
                SELECT * FROM commentaire 
                WHERE n_licence = :n_licence'
            );
            $requete->execute([':n_licence' => $n_licence]);
            while ($res = $requete->fetch(PDO::FETCH_ASSOC)) {
                $commentaires[] = new Commentaire($res['n_licence'], $res['date_Com'], $res['commentaire']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $commentaires;
    }

    // Méthode pour récupérer tous les commentaires (non filtrés par joueur)
    public function findAll() {
        $commentaires = [];
        try {
            $requete = $this->pdo->query('SELECT * FROM commentaire');
            while ($res = $requete->fetch(PDO::FETCH_ASSOC)) {
                $commentaires[] = new Commentaire($res['n_licence'], $res['date_Com'], $res['commentaire']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $commentaires;
    }
}
?>
