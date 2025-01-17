<?php 

	namespace Controleur;

	use DAO\JoueurDAO;
	class ObtenirTousLesJoueurs{ 

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