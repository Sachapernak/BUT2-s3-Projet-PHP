<?php 
	class SupprimerUnJoueur { 

		// définition des attributs 
		private $joueurDAO;
        private $n_licence;

		  
		// définition des méthodes 
		public function __construct(JoueurDAO $joueurDAO, $n_licence) { 
			$this->joueurDAO = $joueurDAO;
            $this->n_licence = $n_licence;    
		} 
		
		public function executer(): bool{
           return $this->joueurDAO->delete($this->n_licence);
        }
	} 
?>