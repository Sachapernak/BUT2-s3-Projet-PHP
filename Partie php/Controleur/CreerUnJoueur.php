<?php 
    class CreerUnJoueur { 

        private $joueurDAO;
        private $n_licence;
        private $nom;
        private $prenom;
        private $date_de_naissance;
        private $taille;
        private $poids;
        private $statut;

        public function __construct(JoueurDAO $joueurDAO, Joueur $joueur) { 
            $this->joueurDAO = $joueurDAO;
            $this->n_licence = $joueur->getN_licence();
            $this->nom = $joueur->getNom(); 
            $this->prenom = $joueur->getPrenom(); 
            $this->date_de_naissance = $joueur->getDate_de_naissance(); 
            $this->taille = $joueur->getTaille(); 
            $this->poids = $joueur->getPoids(); 
            $this->statut = $joueur->getStatut();		
        } 

        public function executer() {
            $this->joueurDAO->insert(
                $this->n_licence,
                $this->nom,
                $this->prenom,
                $this->date_de_naissance,
                $this->taille,
                $this->poids,
                $this->statut
            );
        }
    } 
?>
