<?php 

namespace Controleur;

use DAO\JoueurDAO;
use Modele\Joueur;

	class RechercherJoueursActifs{ 

		// définition des attributs 
		private $joueurDAO;
		private $statut;
		  
		// définition des méthodes 
		public function __construct(JoueurDAO $joueurDAO, $statut) { 
			$this->joueurDAO = $joueurDAO;
			$this->statut = $statut; 
		} 
		
		public function executer(): array{
            return $this->joueurDAO->findByStatut($this->statut);
        }
	} 
?>