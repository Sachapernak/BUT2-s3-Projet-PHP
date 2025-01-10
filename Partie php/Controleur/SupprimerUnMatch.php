<?php 

	namespace Controleur;

	use DAO\MatchDAO;
	class SupprimerUnMatch { 

		// définition des attributs 
		private $matchDAO;
        private $id_matchs;

		  
		// définition des méthodes 
		public function __construct(MatchDAO $matchDAO, $id_matchs) { 
			$this->matchDAO = $matchDAO;
            $this->id_matchs = $id_matchs; 
        }    

		
		public function executer(): bool{
            return $this->matchDAO->delete($this->id_matchs);
            
        }
	} 
?>