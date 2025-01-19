<?php 
    namespace Controleur;
	use DAO\JoueurDAO;
    use Modele\Joueur;
    class CreerUnJoueur { 

        private $joueurDAO;            // Objet JoueurDAO pour interagir avec la base de données concernant les joueurs
        private $n_licence;            // Numéro de licence du joueur
        private $nom;                  // Nom du joueur
        private $prenom;               // Prénom du joueur
        private $date_de_naissance;    // Date de naissance du joueur
        private $taille;               // Taille du joueur
        private $poids;                // Poids du joueur
        private $statut;               // Statut du joueur

         /**
         * Constructeur de la classe CreerUnJoueur.
         * Il initialise les propriétés de l'objet avec les informations du joueur passé en paramètre.
         *
         * @param JoueurDAO $joueurDAO Objet JoueurDAO utilisé pour interagir avec la base de données
         * @param Joueur $joueur Objet Joueur contenant les informations à insérer dans la base de données
         */
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


        /**
         * Méthode exécutant l'insertion d'un nouveau joueur dans la base de données.
         * Elle appelle la méthode insert du JoueurDAO avec les informations nécessaires.
         */
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
