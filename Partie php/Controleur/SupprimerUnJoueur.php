<?php 
	class SupprimerUnJoueur { 

		// définition des attributs 
		private $pdo;
        private $n_licence;

		  
		// définition des méthodes 
		public function __construct($pdo, $n_licence) { 
			$this->pdo = $pdo;
            $this->n_licence = $n_licence;    
		} 
		
		public function executer(){
            $requete = $this->pdo->prepare('DELETE FROM joueur WHERE n_licence = :n_licence');
            $requete->execute(array('n_licence' => $this->n_licence));
        }
	} 
?>