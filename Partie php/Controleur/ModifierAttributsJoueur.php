<?php 
	class ModifierIdentiteJoueur { 

		// définition des attributs 
		private $pdo;
        private $n_licence;
        private $taille;
        private $poids;
        private $statut;
		  
		// définition des méthodes 
		public function __construct($pdo, $n_licence, $taille, $poids, $statut) { 
			$this->pdo = $pdo;
            $this->n_licence = $n_licence;
            $this->taille = $taille;
            $this->poids = $poids;
            $this->statut = $statut;
        
		} 
		
		public function executer(){
            $requete = $this->pdo->prepare('UPDATE joueur SET taille = :nvtaille , poids = :nvpoids , statut = :nvstatut WHERE n_licence = :n_licence');
            $requete->execute(array('nvtaille' => $this->taille, 'nvpoids' => $this->poids, 'nvstatut' => $this->statut, 'n_licence' => $this->n_licence));
        }
	} 
?>