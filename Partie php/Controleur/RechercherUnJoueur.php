<?php 

namespace Controleur;

use DAO\JoueurDAO;
use Modele\Joueur;

	class RechercherUnJoueur { 

		// définition des attributs 
		private $joueurDAO;
		private $n_licence;
		  
		// définition des méthodes 
		public function __construct(JoueurDAO $joueurDAO, $n_licence) { 
			$this->joueurDAO = $joueurDAO;
			$this->n_licence = $n_licence; 
		} 
		
		public function executer():Joueur{
            return $this->joueurDAO->findById($this->n_licence);
        }
	} 
?>