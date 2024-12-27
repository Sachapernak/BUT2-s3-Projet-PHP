<?php 
	class ObtenirTousLesJoueurs{ 

		// définition des attributs 
		private $joueurDAO;
		  
		// définition des méthodes 
		public function __construct(JoueurDAO $joueurDAO) { 
			$this->joueurDAO = $joueurDAO;
		} 
		
		public function executer() : array {
            $joueurs = $this->joueurDAO->findAll();
			return $joueurs;
        }
	} 
?>