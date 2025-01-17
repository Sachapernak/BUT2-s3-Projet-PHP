<?php

namespace Controleur;

use DAO\JoueurDAO;
use Modele\Joueur;

class RechercherParAttributsJoueurs
{

	private $joueurDAO;
	private $recherche;

	/**
	 * Constructeur de la classe. Initialise les attributs avec les valeurs passées en paramètre.
	 * 
	 * @param JoueurDAO $joueurDAO Instance de JoueurDAO pour effectuer des requêtes sur les joueurs
	 * @param mixed $recherche Critères de recherche pour filtrer les joueurs (peut être un tableau ou un objet)
	 */
	public function __construct(JoueurDAO $joueurDAO, $recherche)
	{
		$this->joueurDAO = $joueurDAO;
		$this->recherche = $recherche;
	}

	 /**
     * Exécute la recherche des joueurs en fonction des critères fournis.
     * 
     * @return array Liste des joueurs qui correspondent aux critères de recherche
     */
	public function executer(): array
	{
		$joueurs = $this->joueurDAO->findByAttributes($this->recherche);
		return $joueurs;
	}
}
?>