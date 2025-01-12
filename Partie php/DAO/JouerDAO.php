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

    public function moyenneNoteJoueur($n_licence): float{
        try {
            $requete = $this->pdo->prepare('SELECT AVG(note) as moyenne_note FROM jouer WHERE n_licence = :n_licence');
            $requete->execute([ ':n_licence' => $n_licence]);
            $result = $requete->fetch();
            if ($result) {
                return round($result['moyenne_note'], 1);
            }
            return -1;  
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération de tous les joueurs : ' . $e->getMessage();
            return -1;
        }
    }

    public function getPositionFavoriteJoueur($n_licence): string {
        try  {
            $requete = $this->pdo->prepare('SELECT position FROM jouer WHERE n_licence = :n_licence GROUP BY position ORDER BY COUNT(*) DESC LIMIT 1');
            $requete->execute([':n_licence' => $n_licence]);
            $result = $requete->fetch();
            if ($result) {
                return $result['position'];
            }
            return "";  
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération de tous les joueurs : ' . $e->getMessage();
            return "";
        }
    }

    public function getTitularisationsJoueur($n_licence): int {
        try  {
            $requete = $this->pdo->prepare("SELECT n_licence, COUNT(*) AS nb_titularisations FROM jouer WHERE n_licence = :n_licence AND est_remplacant = 0 GROUP BY n_licence");
            $requete->execute([ ':n_licence' => $n_licence]);
            $result = $requete->fetch();
            if ($result) {
                return (int) $result['nb_titularisations'];
            }
            return 0;  
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération de tous les joueurs : ' . $e->getMessage();
            return -1;
        }
    }

    public function getRemplacementsJoueur($n_licence): int {
        try  {
            $requete = $this->pdo->prepare("SELECT n_licence, COUNT(*) AS nb_remplacements FROM jouer WHERE n_licence = :n_licence AND est_remplacant = 1 GROUP BY n_licence");
            $requete->execute([ ':n_licence' => $n_licence]);
            $result = $requete->fetch();
            if ($result) {
                return (int) $result['nb_remplacements'];
            }
            return 0;  
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération de tous les joueurs : ' . $e->getMessage();
            return -1;
        }
    }

    public function getNbMatchsConsecutifsJoueur($n_licence): int {
        try  {
            $requete = $this->pdo->prepare("SELECT j1.n_licence, COUNT(*) AS nb_matchs_consecutifs FROM jouer j1, jouer j2, match_basket m1, match_basket m2
                                        WHERE j1.n_licence = j2.n_licence AND j1.id_match = m1.id_match AND j2.id_match = m2.id_match AND m1.id_match = m2.id_match - 1  
                                        AND j1.n_licence = :n_licence GROUP BY j1.n_licence");
            $requete->execute([ ':n_licence' => $n_licence]);
            $result = $requete->fetch();
            if ($result) {
                return (int) $result['nb_matchs_consecutifs'];
            }
            return 0;  
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération de tous les joueurs : ' . $e->getMessage();
            return -1;
        }
    }

    public function getNbVictoiresJoueur($n_licence){
        try  {
            $requete = $this->pdo->prepare("SELECT COUNT(*) AS nb_victoires FROM jouer j, match_basket m WHERE  j.id_match = m.id_match AND j.n_licence = :n_licence AND m.resultat = 'V'");
            $requete->execute([':n_licence' => $n_licence]);
            $result = $requete->fetch();
            if ($result) {
                return (int) $result['nb_victoires'];
            }
            return 0;  
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération de tous les joueurs : ' . $e->getMessage();
            return -1;
        }
    }

    public function getMeilleurJoueurMatch($id_match){
        try  {
            $requete = $this->pdo->prepare("SELECT * FROM Jouer WHERE id_match= :id_match ORDER BY note DESC LIMIT 1");
            $requete->execute([':id_match' => $id_match]);
            $result = $requete->fetch();
            if ($result) {
                return  $result['n_licence'];
            }
            return 0;  
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération de tous les joueurs : ' . $e->getMessage();
            return -1;
        }
    }
}
?>
