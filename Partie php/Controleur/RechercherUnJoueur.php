<?php 
	class RechercherUnJoueur { 

		// définition des attributs 
		private $joueurDAO;
		private $n_licence;
		  
		// définition des méthodes 
		public function __construct($n_licence) { 
			$this->joueurDAO = new JoueurDAO();
			$this->n_licence = $n_licence; 
		} 
		
		public function executer():Joueur{
            $this->joueurDAO->findById($this->n_licence);
        }
	} 
?>