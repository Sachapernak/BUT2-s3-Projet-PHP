<?php

namespace Controleur;

use DAO\JoueurDAO;
use Modele\Joueur;

class RechercherUnJoueur
{


	private $joueurDAO;
	private $n_licence;

	/**
	 * Constructeur de la classe. Initialise les attributs avec les valeurs passées en paramètre.
	 * 
	 * @param JoueurDAO $joueurDAO Instance de JoueurDAO pour effectuer des requêtes sur les joueurs
	 * @param string $n_licence Numéro de licence du joueur à rechercher
	 */
	public function __construct(JoueurDAO $joueurDAO, $n_licence)
	{
		$this->joueurDAO = $joueurDAO;
		$this->n_licence = $n_licence;
	}

	/**
     * Exécute la recherche d'un joueur spécifique en fonction du numéro de licence.
     * 
     * @return Joueur Le joueur correspondant au numéro de licence donné
     */
	public function executer(): Joueur
	{
		return $this->joueurDAO->findById($this->n_licence);
	}
}
?>