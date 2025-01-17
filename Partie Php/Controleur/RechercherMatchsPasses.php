<?php 
	namespace Controleur;

	use DAO\MatchDAO;
	class RechercherMatchsPasses{ 

		// définition des attributs 
		private $matchDAO;
        private $dateMatch;
		  
		// définition des méthodes 
		public function __construct(MatchDAO $matchDAO, $dateMatch) { 
			$this->matchDAO = $matchDAO;
            $this->dateMatch = $dateMatch;
		} 
		
		public function executer() : array {
            $matchs = $this->matchDAO->findOldMatch();
			return $matchs;
        }
	} 
?>