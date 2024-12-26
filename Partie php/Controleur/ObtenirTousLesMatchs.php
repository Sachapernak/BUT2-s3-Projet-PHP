<?php 
	class ObtenirTousLesMatchs{ 

		// définition des attributs 
		private $matchDAO;
		  
		// définition des méthodes 
		public function __construct() { 
			$this->matchDAO = new MatchDAO();
		} 
		
		public function executer() : array {
            $matchs = $this->matchDAO->findAll();
			return $matchs;
        }
	} 
?>