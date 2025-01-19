<?php

namespace Controleur;

use DAO\JoueurDAO;
class ObtenirTousLesJoueurs
{

	private $joueurDAO;

	/**
	 * Le constructeur initialise l'objet JoueurDAO qui sera utilisé pour accéder à la base de données des joueurs.
	 *
	 * @param JoueurDAO $joueurDAO L'objet JoueurDAO utilisé pour interagir avec les joueurs dans la base de données.
	 */
	public function __construct(JoueurDAO $joueurDAO)
	{
		$this->joueurDAO = $joueurDAO;
	}

	/**
	 * Cette méthode récupère tous les joueurs de la base de données en appelant la méthode `findAll()` de JoueurDAO.
	 *
	 * @return array Un tableau contenant tous les joueurs récupérés de la base de données.
	 */
	public function executer(): array
	{
		$joueurs = $this->joueurDAO->findAll();
		return $joueurs;
	}
}
?>