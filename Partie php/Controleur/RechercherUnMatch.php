<?php 
	class RechercherUnMatch{ 

		// définition des attributs 
		private $matchDAO;
		private $id_matchs;
		  
		// définition des méthodes 
		public function __construct($id_matchs) { 
			$this->macthDAO = new MatchDAO();
			$this->id_matchs = $id_matchs; 
		} 
		
		public function executer():Joueur{
            $this->matchDAO->findById($this->id_matchs);
        }
	} 
?>