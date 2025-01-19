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

    //Méthode pour insérer un joueur dans la base de données
    public function insert($n_licence, $nom, $prenom, $date_de_naissance, $taille, $poids, $statut): void
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

    //Méthode pour mettre à jour un joueur
    public function update($n_licence, $nom, $prenom, $taille, $poids, $statut, $date_de_naissance): void
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

    //Méthode pour supprimer un joueur à partir de son numéro de licence (identifiant)
    public function delete($n_licence): bool
    {
        $res = false;
        try 
        {
            $requeteSupprCommentaires = $this->connexion->prepare('DELETE FROM commentaire WHERE n_licence = :n_licence');
            $requeteSupprCommentaires->execute(array('n_licence' => $n_licence));

            $requeteSupprJoueur = $this->connexion->prepare('DELETE FROM joueur WHERE n_licence = :n_licence');
            $requeteSupprJoueur->execute(array('n_licence' => $n_licence));
            $res = $requeteSupprJoueur->rowCount() > 0;
        } catch (Exception $e) {
            echo 'Erreur lors de la suppression : ' . $e->getMessage();
        }

        return $res;
    }

    //Méthode pour récuperer un joueur à partir de son identifiant
    public function findById($n_licence): ?Joueur
    {
        $joueur = null;
        try {
            $requete = $this->connexion->prepare('SELECT * FROM joueur WHERE n_licence = :n_licence');
            $requete->execute(array('n_licence' => $n_licence));
            $res = $requete->fetch();
            if ($res) {
                $joueur = new Joueur($res['n_licence'], $res['nom'], $res['prenom'], $res['date_de_naissance'], $res['taille'], $res['poids'], $res['statut']);
            }
        } catch (Exception $e) {
            echo 'Erreur lors de la recherche : ' . $e->getMessage();
        }
        return $joueur;
    }

    //Méthode pour effectuer une recherche de joueur selon son nom, prenom ou numéro de licence
    public function findByAttributes($recherche): array{
        try {
            $requete = $this->connexion->prepare('SELECT * FROM joueur WHERE n_licence LIKE :recherche1 OR nom LIKE :recherche2 OR prenom LIKE :recherche3');
            $requete->execute([':recherche1' => '%' . $recherche . '%', ':recherche2' => '%' . $recherche . '%', ':recherche3' => '%' . $recherche . '%']);
            $joueurs = [];
            while ($res = $requete->fetch()) {
                $joueurs[] = new Joueur($res['n_licence'], $res['nom'], $res['prenom'], $res['date_de_naissance'], $res['taille'], $res['poids'], $res['statut']);
            }

        } catch (Exception $e) {
            echo 'Erreur lors de la recherche : ' . $e->getMessage();
        }
        return $joueurs;

    }

    //Méthode pour récupérer les joueurs possèdant le statut passé en argument
    public function findByStatut($statut): array{
        try {
            $requete = $this->connexion->prepare('SELECT * FROM joueur WHERE statut = :statut');
            $requete->execute([':statut' => $statut]);
            $joueurs = [];
            while ($res = $requete->fetch()) {
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
            while ($res = $requete->fetch()) {
                $joueurs[] = new Joueur($res['n_licence'], $res['nom'], $res['prenom'], $res['date_de_naissance'], $res['taille'], $res['poids'], $res['statut']);
            }

        } catch (Exception $e) {
            echo 'Erreur lors de la recherche : ' . $e->getMessage();
        }
        return $joueurs;

    }
}
?>