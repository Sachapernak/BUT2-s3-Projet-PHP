<?php 
	class ObtenirTousLesJoueurs{ 

		// définition des attributs 
		private $joueurDAO;
		  
		// définition des méthodes 
		public function __construct() { 
			$this->joueurDAO = new JoueurDAO();
		} 
		
		public function executer() : array {
            $joueurs = $this->joueurDAO->findAll();
			return $joueurs;
        }
	} 
?>