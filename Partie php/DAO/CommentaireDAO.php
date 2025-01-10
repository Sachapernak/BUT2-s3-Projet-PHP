<?php
class CommentaireDAO {

    // Définition des attributs
    private $pdo;

    // Définition des méthodes
    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=ma_base', 'user', 'password');
        } catch (Exception $e) {
            die('Erreur de connexion à la BD : ' . $e->getMessage());
        }
    }

    // Méthode pour insérer un commentaire
    public function insert($n_licence, $date_com, $commentaire) {
        try {
            $requete = $this->pdo->prepare('
                INSERT INTO Commentaire (N_Licence, Date_Com, Commentaire)
                VALUES (:n_licence, STR_TO_DATE(:date_com, "%d/%m/%Y"), :commentaire)'
            );
            $requete->execute([
                ':n_licence' => $n_licence,
                ':date_com' => $date_com,
                ':commentaire' => $commentaire
            ]);
        } catch (Exception $e) {
            echo 'Erreur lors de l\'insertion : ' . $e->getMessage();
        }
    }

    // Méthode pour mettre à jour un commentaire
    public function update($n_licence, $date_com, $commentaire) {
        try {
            $requete = $this->pdo->prepare('
                UPDATE Commentaire 
                SET Commentaire = :commentaire 
                WHERE N_Licence = :n_licence AND Date_Com = STR_TO_DATE(:date_com, "%d/%m/%Y")'
            );
            $requete->execute([
                ':n_licence' => $n_licence,
                ':date_com' => $date_com,
                ':commentaire' => $commentaire
            ]);
        } catch (Exception $e) {
            echo 'Erreur lors de la mise à jour : ' . $e->getMessage();
        }
    }

    // Méthode pour supprimer un commentaire
    public function delete($n_licence, $date_com) {
        $res = false;
        try {
            $requete = $this->pdo->prepare('
                DELETE FROM Commentaire 
                WHERE N_Licence = :n_licence AND Date_Com = STR_TO_DATE(:date_com, "%d/%m/%Y")'
            );
            $requete->execute([
                ':n_licence' => $n_licence,
                ':date_com' => $date_com
            ]);
            $res = $requete->rowCount() > 0; // Retourne true si une ligne a été supprimée
        } catch (Exception $e) {
            echo 'Erreur lors de la suppression : ' . $e->getMessage();
        }
        return $res;
    }

    // Méthode pour récupérer un commentaire par licence et date
    public function findById($n_licence, $date_com) {
        $commentaire = null;
        try {
            $requete = $this->pdo->prepare('
                SELECT * FROM Commentaire 
                WHERE N_Licence = :n_licence AND Date_Com = STR_TO_DATE(:date_com, "%d/%m/%Y")'
            );
            $requete->execute([
                ':n_licence' => $n_licence,
                ':date_com' => $date_com
            ]);
            $res = $requete->fetch(PDO::FETCH_ASSOC);
            if ($res) {
                $commentaire = new Commentaire($res['N_Licence'], $res['Date_Com'], $res['Commentaire']);
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
                SELECT * FROM Commentaire 
                WHERE N_Licence = :n_licence'
            );
            $requete->execute([':n_licence' => $n_licence]);
            while ($res = $requete->fetch(PDO::FETCH_ASSOC)) {
                $commentaires[] = new Commentaire($res['N_Licence'], $res['Date_Com'], $res['Commentaire']);
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
            $requete = $this->pdo->query('SELECT * FROM Commentaire');
            while ($res = $requete->fetch(PDO::FETCH_ASSOC)) {
                $commentaires[] = new Commentaire($res['N_Licence'], $res['Date_Com'], $res['Commentaire']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la récupération : ' . $e->getMessage();
        }
        return $commentaires;
    }
}
?>
