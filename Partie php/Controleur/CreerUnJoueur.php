<?php 
	class CreerUnJoueur { 
 
        private $pdo
        private $n_licence
		private $nom;
		private $prenom;
		private $date_de_naissance;
		private $taille;
		private $poids;
		private $staut;

		  
		public function __construct($pdo, $n_licence, $nom, $prenom, $date_de_naissance, $taille, $poids, $staut) { 
            $this->pdo = $pdo; 
            $this->n_licence = $n_licence;
            $this->nom = $nom; 
			$this->prenom = $pren; 
			$this->date_de_naissance = $date_de_naissance; 
			$this->taille = $taille; 
			$this->poids = $poids; 
			$this->statut = $statut;		
		} 
		
		public function executer():Joueur{
			$joueur = new Joueur($this->pdo, $this->n_licence, $this->nom, $this->prenom, $this->date_de_naissance, $this->taille, $this->poids, $this->status)			
			return $joueur;
		}
	} 
?>