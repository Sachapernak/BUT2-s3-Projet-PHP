<?php 
    namespace Controleur;
    use DAO\JoueurDAO;
    use Modele\Joueur;
	class ModifierJoueur { 

		// définition des attributs 
		private $joueurDAO;
        private $n_licence;
		private $nom;
        private $prenom;
		private $taille;
        private $poids;
        private $statut;
		private $date_naissance;
		  
		// définition des méthodes 
		public function __construct(JoueurDAO $joueurDAO, Joueur $joueur) { 
			$this->joueurDAO = $joueurDAO;
            $this->n_licence = $joueur->getN_licence();
            $this->nom = $joueur->getNom(); 
            $this->prenom = $joueur->getPrenom(); 
            $this->date_naissance = $joueur->getDate_de_naissance(); 
            $this->taille = $joueur->getTaille(); 
            $this->poids = $joueur->getPoids(); 
            $this->statut = $joueur->getStatut();	

		} 
		
		public function executer(){
           $this->joueurDAO->update($this->n_licence, $this->nom, $this->prenom, $this->taille, $this->poids, $this->statut, $this->date_naissance);
        }
	} 
?>