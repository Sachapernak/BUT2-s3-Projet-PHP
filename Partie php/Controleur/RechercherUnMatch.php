<?php 

	namespace Controleur;

	use DAO\MatchDAO;
	use Modele\MatchBasket;
	class RechercherUnMatch{ 

		// définition des attributs 
		private $matchDAO;
		private $id_match;
		  
		// définition des méthodes 
		public function __construct(MatchDAO $matchDAO, $id_match) { 
			$this->matchDAO = $matchDAO;
			$this->id_match = $id_match; 
		} 
		
		public function executer(): MatchBasket|null{
            return $this->matchDAO->findById($this->id_match);
        }
	} 
?>