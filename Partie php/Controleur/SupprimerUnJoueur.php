<?php
namespace Controleur;

use DAO\JoueurDAO;

class SupprimerUnJoueur
{

	private $joueurDAO;
	private $n_licence;


	/**
	 * Constructeur de la classe. Initialise les attributs avec les valeurs passées en paramètre.
	 * 
	 * @param JoueurDAO $joueurDAO Instance de JoueurDAO pour effectuer des requêtes sur la base de données des joueurs
	 * @param string $n_licence Numéro de licence du joueur à supprimer
	 */
	public function __construct(JoueurDAO $joueurDAO, $n_licence)
	{
		$this->joueurDAO = $joueurDAO;
		$this->n_licence = $n_licence;
	}
	
	/**
	 * Exécute la suppression du joueur correspondant à son numéro de licence.
	 * 
	 * @return bool Retourne true si la suppression a réussi, false sinon
	 */
	public function executer(): bool
	{
		return $this->joueurDAO->delete($this->n_licence);
	}
}
?>