<?php 

namespace Controleur;

use DAO\JouerDAO;

	class ObtenirMoyenneNoteJoueur { 

		// définition des attributs 
		private $jouerDAO;
		private $n_licence;
		  
		// définition des méthodes 
		public function __construct(JouerDAO $jouerDAO, $n_licence) { 
			$this->jouerDAO = $jouerDAO;
			$this->n_licence = $n_licence; 
		} 
		
		public function executer():int{
            return round($this->jouerDAO->moyenneNoteJoueur($this->n_licence));
        }
	} 
?>