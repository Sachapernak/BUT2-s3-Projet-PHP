<?php
class JouerDAO {

    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=ma_base', 'user', 'password');
        } catch (Exception $e) {
            die('Erreur de connexion à la BD : ' . $e->getMessage());
        }
    }

    public function insert($n_licence, $id_matchs, $est_remplacant, $note, $role) {
        try {
            $requete = $this->pdo->prepare('
                INSERT INTO jouer (N_Licence, Id_Matchs, est_remplacant, note, role)
                VALUES (:n_licence, :id_matchs, :est_remplacant, :note, :role)
            ');
            $requete->execute([
                ':n_licence' => $n_licence,
                ':id_matchs' => $id_matchs,
                ':est_remplacant' => $est_remplacant,
                ':note' => $note,
                ':role' => $role
            ]);
        } catch (Exception $e) {
            echo 'Erreur lors de l\'insertion : ' . $e->getMessage();
        }
    }

    public function update($n_licence, $id_matchs, $est_remplacant, $note, $role) {
        try {
            $requete = $this->pdo->prepare('
                UPDATE jouer
                SET est_remplacant = :est_remplacant, note = :note, role = :role
                WHERE N_Licence = :n_licence AND Id_Matchs = :id_matchs
            ');
            $requete->execute([
                ':n_licence' => $n_licence,
                ':id_matchs' => $id_matchs,
                ':est_remplacant' => $est_remplacant,
                ':note' => $note,
                ':role' => $role
            ]);
        } catch (Exception $e) {
            echo 'Erreur lors de la mise à jour : ' . $e->getMessage();
        }
    }

    public function delete($n_licence, $id_matchs) {
        try {
            $requete = $this->pdo->prepare('
                DELETE FROM jouer WHERE N_Licence = :n_licence AND Id_Matchs = :id_matchs
            ');
            $requete->execute([
                ':n_licence' => $n_licence,
                ':id_matchs' => $id_matchs
            ]);
            return $requete->rowCount() > 0;
        } catch (Exception $e) {
            echo 'Erreur lors de la suppression : ' . $e->getMessage();
            return false;
        }
    }

    public function findById($n_licence, $id_matchs) {
        try {
            $requete = $this->pdo->prepare('
                SELECT * FROM jouer WHERE N_Licence = :n_licence AND Id_Matchs = :id_matchs
            ');
            $requete->execute([
                ':n_licence' => $n_licence,
                ':id_matchs' => $id_matchs
            ]);
            $result = $requete->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return new Jouer($result['N_Licence'], $result['Id_Matchs'], $result['est_remplacant'], $result['note'], $result['role']);
            }
            return null;
        } catch (Exception $e) {
            echo 'Erreur lors de la recherche : ' . $e->getMessage();
            return null;
        }
    }

    // Nouvelle méthode : findByIdJoueur
    public function findByIdJoueur($n_licence): array {
        try {
            $requete = $this->pdo->prepare('
                SELECT * FROM jouer WHERE N_Licence = :n_licence
            ');
            $requete->execute([
                ':n_licence' => $n_licence
            ]);
            $result = $requete->fetchAll(PDO::FETCH_ASSOC); 
            
            if ($result) {
                $jouer = [];
                foreach ($result as $row) {
                    $jouer[] = new Jouer($row['N_Licence'], $row['Id_Matchs'], $row['est_remplacant'], $row['note'], $row['role']);
                }
                return $jouer; 
            }
            return [];
        } catch (Exception $e) {
            echo 'Erreur lors de la recherche : ' . $e->getMessage();
            return []; // Retourner un tableau vide en cas d'erreur
        }
    }
    
    public function findByIdMatch($id_matchs): array {
        try {
            $requete = $this->pdo->prepare('
                SELECT * FROM jouer WHERE Id_Matchs = :id_matchs
            ');
            $requete->execute([
                ':id_matchs' => $id_matchs
            ]);
            $result = $requete->fetchAll(PDO::FETCH_ASSOC);
            $jouer = [];
            foreach ($result as $row) {
                $jouer[] = new Jouer($row['N_Licence'], $row['Id_Matchs'], $row['est_remplacant'], $row['note'], $row['role']);
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
            while ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
                $jouer[] = new Jouer($result['N_Licence'], $result['Id_Matchs'], $result['est_remplacant'], $result['note'], $result['role']);
            }
            return $jouer;
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération de tous les joueurs : ' . $e->getMessage();
            return [];
        }
    }
}
?>
