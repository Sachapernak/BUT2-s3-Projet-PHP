<?php 
	class SupprimerUnMatch { 

		// définition des attributs 
		private $matchDAO;
        private $id_matchs;

		  
		// définition des méthodes 
		public function __construct($pdo, $n_licence) { 
			$this->matchDAO = new MatchDAO();
            $this->n_licence = $n_licence;    
		} 
		
		public function executer(){
            $requete = $this->matchDAO->delete($this->id_matchs);
            
        }
	} 
?>