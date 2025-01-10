<?php 
	class ObtenirTousLesMatchs{ 

		// définition des attributs 
		private $matchDAO;
		  
		// définition des méthodes 
		public function __construct(MatchDAO $matchDAO) { 
			$this->matchDAO = $matchDAO;
		} 
		
		public function executer() : array {
            $matchs = $this->matchDAO->findAll();
			return $matchs;
        }
	} 
?>