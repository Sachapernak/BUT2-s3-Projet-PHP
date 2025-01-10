<?php

namespace DAO;
use Modele\Joueur;
use Modele\Database;
use PDO;
class JoueurDAO
{

    // définition des attributs 
    private $connexion;

    // définition des méthodes 
    public function __construct()
    {
        try {
            $this->connexion = Database::getInstance();;
        } catch (Exception $e) {
            die('Erreur de connexion a la BD : ' . $e->getMessage());
        }
    }

    public function insert($n_licence, $nom, $prenom, $date_de_naissance, $taille, $poids, $statut)
    {
        try {
            $requete = $this->connexion->prepare('
                INSERT INTO joueur (n_licence, nom, prenom, date_de_naissance, taille, poids, statut)
                VALUES (:n_licence, :nom, :prenom, :date_de_naissance, :taille, :poids, :statut)'
            );
            $requete->execute([
                ':n_licence' => $n_licence,
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':date_de_naissance' => $date_de_naissance,
                ':taille' => $taille,
                ':poids' => $poids,
                ':statut' => $statut
            ]);

        } catch (Exception $e) {
            echo 'Erreur lors de l\'insertion : ' . $e->getMessage();
        }

    }

    public function update($n_licence, $nom, $prenom, $taille, $poids, $statut, $date_de_naissance)
    {
        try {
            $requete = $this->connexion->prepare('UPDATE joueur SET nom = :nvnom , 
                                            prenom = :nvprenom , 
                                            taille = :nvtaille , 
                                            poids = :nvpoids , 
                                            statut = :nvstatut, 
                                            date_de_naissance = :nvdate_naissance
                                            WHERE n_licence = :n_licence');

            $requete->execute(array(
                'nvnom' => $nom,
                'nvprenom' => $prenom,
                'nvtaille' => $taille,
                'nvpoids' => $poids,
                'nvstatut' => $statut,
                'nvdate_naissance' => $date_de_naissance,
                'n_licence' => $n_licence
            ));

        } catch (Exception $e) {
            echo 'Erreur lors de la mise à jour : ' . $e->getMessage();
        }


    }

    public function delete($n_licence): bool
    {
        $res = false;
        try 
        {
            $requeteSupprCommentaires = $this->connexion->prepare('DELETE FROM Commentaires WHERE n_licence = :n_licence');
            $requeteSupprCommentaires->execute(array('n_licence' => $n_licence));

            $requeteSupprJouer = $this->connexion->prepare('DELETE FROM Jouer WHERE n_licence = :n_licence');
            $requeteSupprJouer->execute(array('n_licence' => $n_licence));
            
            $requeteSupprJoueur = $this->connexion->prepare('DELETE FROM Joueur WHERE n_licence = :n_licence');
            $requeteSupprJoueur->execute(array('n_licence' => $n_licence));
            $res = $requeteSupprJoueur->rowCount() > 0;
        } catch (Exception $e) {
            echo 'Erreur lors de la suppression : ' . $e->getMessage();
        }

        return $res;
    }

    public function findById($n_licence): Joueur
    {
        $joueur = null;
        try {
            $requete = $this->connexion->prepare('SELECT * FROM joueur WHERE n_licence = :n_licence');
            $requete->execute(array('n_licence' => $n_licence));
            $res = $requete->fetch(PDO::FETCH_ASSOC);
            if ($res) {
                $joueur = new Joueur($res['n_licence'], $res['nom'], $res['prenom'], $res['date_de_naissance'], $res['taille'], $res['poids'], $res['statut']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la recherche : ' . $e->getMessage();
        }
        return $joueur;
    }

    public function findByAttributes($recherche): array{
        try {
            $requete = $this->connexion->prepare('SELECT * FROM joueur WHERE n_licence LIKE :recherche1 OR nom LIKE :recherche2 OR prenom LIKE :recherche3');
            $requete->execute([':recherche1' => '%' . $recherche . '%', ':recherche2' => '%' . $recherche . '%', ':recherche3' => '%' . $recherche . '%']);
            $joueurs = [];
            while ($res = $requete->fetch(PDO::FETCH_ASSOC)) {
                $joueurs[] = new Joueur($res['n_licence'], $res['nom'], $res['prenom'], $res['date_de_naissance'], $res['taille'], $res['poids'], $res['statut']);
            }

        } catch (Exception $e) {
            echo 'Erreur lors de la recherche : ' . $e->getMessage();
        }
        return $joueurs;

    }

    public function findAll(): array
    {
        try {
            $requete = $this->connexion->query('SELECT * FROM joueur');
            $joueurs = [];
            while ($res = $requete->fetch(PDO::FETCH_ASSOC)) {
                $joueurs[] = new Joueur($res['n_licence'], $res['nom'], $res['prenom'], $res['date_de_naissance'], $res['taille'], $res['poids'], $res['statut']);
            }

        } catch (Exception $e) {
            echo 'Erreur lors de la recherche : ' . $e->getMessage();
        }
        return $joueurs;

    }
}
?>