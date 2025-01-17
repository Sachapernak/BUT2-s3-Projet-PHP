<?php 

namespace Controleur;

use DAO\JoueurDAO;
use Modele\Joueur;

	class RechercherParAttributsJoueurs { 

		// définition des attributs 
		private $joueurDAO;
		private $recherche;
		  
		// définition des méthodes 
		public function __construct(JoueurDAO $joueurDAO, $recherche) { 
			$this->joueurDAO = $joueurDAO;
			$this->recherche = $recherche; 
		} 
		
		public function executer(): array{
            $joueurs = $this->joueurDAO->findByAttributes($this->recherche);
            return $joueurs;
        }
	} 
?>