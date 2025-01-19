<?php
namespace Controleur;

use DAO\MatchDAO;
class ObtenirTousLesMatchs
{

	// définition des attributs 
	private $matchDAO;

	/**
	 * Le constructeur initialise l'objet MatchDAO qui sera utilisé pour accéder à la base de données des matchs.
	 *
	 * @param MatchDAO $matchDAO L'objet MatchDAO utilisé pour interagir avec les matchs dans la base de données.
	 */
	public function __construct(MatchDAO $matchDAO)
	{
		$this->matchDAO = $matchDAO;
	}

	/**
	 * Cette méthode récupère tous les matchs de la base de données en appelant la méthode `findAll()` de MatchDAO.
	 *
	 * @return array Un tableau contenant tous les matchs récupérés de la base de données.
	 */
	public function executer(): array
	{
		$matchs = $this->matchDAO->findAll();
		return $matchs;
	}
}
?>