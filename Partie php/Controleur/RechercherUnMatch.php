<?php 

	namespace Controleur;

	use DAO\MatchDAO;
	use Modele\Match_Basket;
	class RechercherUnMatch{ 

		// définition des attributs 
		private $matchDAO;
		private $id_matchs;
		  
		// définition des méthodes 
		public function __construct(MatchDAO $matchDAO, $id_matchs) { 
			$this->matchDAO = $matchDAO;
			$this->id_matchs = $id_matchs; 
		} 
		
		public function executer(): Match_Basket{
            return $this->matchDAO->findById($this->id_matchs);
        }
	} 
?>