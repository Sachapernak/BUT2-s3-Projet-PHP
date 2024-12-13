<?php 
    class CreerUnJoueur { 

        private $pdo;
        private $n_licence;
        private $nom;
        private $prenom;
        private $date_de_naissance;
        private $taille;
        private $poids;
        private $statut;

        public function __construct($pdo, $n_licence, $nom, $prenom, $date_de_naissance, $taille, $poids, $statut) { 
            $this->pdo = $pdo; 
            $this->n_licence = $n_licence;
            $this->nom = $nom; 
            $this->prenom = $prenom; 
            $this->date_de_naissance = $date_de_naissance; 
            $this->taille = $taille; 
            $this->poids = $poids; 
            $this->statut = $statut;		
        } 

        public function executer() {
            $requete = $this->pdo->prepare("
                INSERT INTO joueur (n_licence, nom, prenom, date_de_naissance, taille, poids, statut)
                VALUES (:n_licence, :nom, :prenom, :date_de_naissance, :taille, :poids, :statut)"
            );
            $requete->execute([
                ':n_licence' => $this->n_licence,
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
                ':date_de_naissance' => $this->date_de_naissance,
                ':taille' => $this->taille,
                ':poids' => $this->poids,
                ':statut' => $this->statut
            ]);
        }
    } 
?>
