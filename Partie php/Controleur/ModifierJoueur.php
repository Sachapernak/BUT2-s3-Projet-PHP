<?php 
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
		public function __construct($n_licence, $nom, $prenom, $taille, $poids, $statut, $date_naissance) { 
			$this->joueurDAO = new JoueurDAO();
            $this->n_licence = $n_licence;
            $this->nom = $nom;
            $this->prenom = $prenom;  
			$this->taille = $taille;
            $this->poids = $poids;
            $this->statut = $statut;     
			$this->date_naissance = $date_naissance; 
		} 
		
		public function executer(){
           $this->joueurDAO->update($this->n_licence, $this->nom, $this->prenom, $this->taille, $this->poids, $this->statut, $this->date_naissance);
        }
	} 
?>