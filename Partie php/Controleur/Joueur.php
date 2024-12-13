<?php 
	class Joueur { 
        
        private $n_licence;
		private $nom;
		private $prenom;
		private $date_de_naissance;
		private $taille;
		private $poids;
		private $statut;

		public function __construct($n_licence, $nom, $prenom, $date_de_naissance, $taille, $poids, $statut) { 
			$this->n_licence = $n_licence;
            $this->nom = $nom; 
			$this->prenom = $pren; 
			$this->date_de_naissance = $date_de_naissance; 
			$this->taille = $taille; 
			$this->poids = $poids; 
			$this->statut = $statut;
		} 

	} 
?>