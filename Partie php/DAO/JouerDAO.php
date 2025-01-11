<?php

namespace DAO;

use PDO;
use Modele\Database;
use Modele\Jouer;
class JouerDAO {

    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::getInstance();
        } catch (Exception $e) {
            die('Erreur de connexion à la BD : ' . $e->getMessage());
        }
    }

    public function insert($n_licence, $id_match, $est_remplacant, $note, $position) {
        try {
            $requete = $this->pdo->prepare('
                INSERT INTO jouer (n_licence, id_match, est_remplacant, note, position)
                VALUES (:n_licence, :id_match, :est_remplacant, :note, :position)
            ');
            $requete->execute([
                ':n_licence' => $n_licence,
                ':id_match' => $id_match,
                ':est_remplacant' => $est_remplacant,
                ':note' => $note,
                ':position' => $position
            ]);
        } catch (Exception $e) {
            echo 'Erreur lors de l\'insertion : ' . $e->getMessage();
        }
    }

    public function update($n_licence, $id_match, $est_remplacant, $note, $position) {
        try {
            $requete = $this->pdo->prepare('
                UPDATE jouer
                SET est_remplacant = :est_remplacant, note = :note, position = :position
                WHERE n_licence = :n_licence AND id_match = :id_match
            ');
            $requete->execute([
                ':n_licence' => $n_licence,
                ':id_match' => $id_match,
                ':est_remplacant' => $est_remplacant,
                ':note' => $note,
                ':position' => $position
            ]);
        } catch (Exception $e) {
            echo 'Erreur lors de la mise à jour : ' . $e->getMessage();
        }
    }

    public function delete($n_licence, $id_match) {
        try {
            $requete = $this->pdo->prepare('
                DELETE FROM jouer WHERE n_licence = :n_licence AND id_match = :id_match
            ');
            $requete->execute([
                ':n_licence' => $n_licence,
                ':id_match' => $id_match
            ]);
            return $requete->rowCount() > 0;
        } catch (Exception $e) {
            echo 'Erreur lors de la suppression : ' . $e->getMessage();
            return false;
        }
    }

    public function findById($n_licence, $id_match): Jouer|null {
        try {
            $requete = $this->pdo->prepare('
                SELECT * FROM jouer WHERE n_licence = :n_licence AND id_match = :id_match
            ');
            $requete->execute([
                ':n_licence' => $n_licence,
                ':id_match' => $id_match
            ]);
            $result = $requete->fetch();
            if ($result) {
                return new Jouer($result['n_licence'], $result['id_match'], $result['est_remplacant'], $result['note'], $result['position']);
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la recherche : ' . $e->getMessage();
            return null;
        }
    }

    // Nouvelle méthode : findByIdJoueur
    public function findByIdJoueur($n_licence): array {
        try {
            $requete = $this->pdo->prepare('
                SELECT * FROM jouer WHERE n_licence = :n_licence
            ');
            $requete->execute([
                ':n_licence' => $n_licence
            ]);
            $result = $requete->fetchAll(); 
            
            if ($result) {
                $jouer = [];
                foreach ($result as $row) {
                    $jouer[] = new Jouer($row['n_licence'], $row['id_match'], $row['est_remplacant'], $row['note'], $row['position']);
                }
                return $jouer; 
            }
            return [];
        } catch (Exception $e) {
            echo 'Erreur lors de la recherche : ' . $e->getMessage();
            return []; 
        }
    }
    
    public function findByIdMatch($id_match): array {
        try {
            $requete = $this->pdo->prepare('
                SELECT * FROM jouer WHERE id_match = :id_match
            ');
            $requete->execute([
                ':id_match' => $id_match
            ]);
            $result = $requete->fetchAll();
            $jouer = [];
            foreach ($result as $row) {
                $jouer[] = new Jouer($row['n_licence'], $row['id_match'], $row['est_remplacant'], $row['note'], $row['position']);
            }
            return $jouer;  
        } catch (Exception $e) {
            echo 'Erreur lors de la recherche des joueurs pour le match : ' . $e->getMessage();
            return [];
        }
    }

    public function findAll() {
        try {
            $requete = $this->pdo->query('SELECT * FROM jouer');
            $jouer = [];
            while ($result = $requete->fetch()) {
                $jouer[] = new Jouer($result['n_licence'], $result['id_match'], $result['est_remplacant'], $result['note'], $result['position']);
            }
            return $jouer;
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération de tous les joueurs : ' . $e->getMessage();
            return [];
        }
    }

    public function moyenneNoteJoueur($n_licence): int{
        try {
            $requete = $this->pdo->prepare('SELECT AVG(note) as moyenne_note FROM jouer WHERE n_licence = :n_licence');
            $requete->execute([ ':n_licence' => $n_licence]);
            $result = $requete->fetch();
            if ($result) {
                return (int) $result['moyenne_note'];
            }
            return -1;  
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération de tous les joueurs : ' . $e->getMessage();
            return -1;
        }
    }
}
?>
