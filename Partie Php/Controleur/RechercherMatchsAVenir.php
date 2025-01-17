<?php 
	namespace Controleur;

	use DAO\MatchDAO;
	class RechercherMatchsAVenir{ 

		// définition des attributs 
		private $matchDAO;
        private $dateMatch;
		  
		// définition des méthodes 
		public function __construct(MatchDAO $matchDAO, $dateMatch) { 
			$this->matchDAO = $matchDAO;
            $this->dateMatch = $dateMatch;
		} 
		
		public function executer() : array {
            $matchs = $this->matchDAO->findComingMatch();
			return $matchs;
        }
	} 
?>