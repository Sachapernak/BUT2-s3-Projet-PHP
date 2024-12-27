<?php 
	class SupprimerUnJoueur { 

		// définition des attributs 
		private $joueurDAO;
        private $n_licence;

		  
		// définition des méthodes 
		public function __construct($n_licence) { 
			$this->joueurDAO = new JoueurDAO();
            $this->n_licence = $n_licence;    
		} 
		
		public function executer(){
            $requete = $this->joueurDAO->delete($this->n_licence);
        }
	} 
?>