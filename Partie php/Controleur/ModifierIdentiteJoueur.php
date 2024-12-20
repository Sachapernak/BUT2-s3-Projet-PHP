<?php 
	class ModifierIdentiteJoueur { 

		// définition des attributs 
		private $pdo;
        private $n_licence;
		private $nom;
        private $prenom;
		  
		// définition des méthodes 
		public function __construct($pdo, $n_licence, $nom, $prenom) { 
			$this->pdo = $pdo;
            $this->n_licence = $n_licence;
            $this->nom = $nom;
            $this->prenom = $prenom;        
		} 
		
		public function executer(){
            $requete = $this->pdo->prepare('UPDATE joueur SET nom = :nvnom , prenom = :nvprenom WHERE n_licence = :n_licence');
            $requete->execute(array('nvnom' => $this->nom, 'nvprenom' => $this->prenom, 'n_licence' => $this->n_licence));
        }
	} 
?>