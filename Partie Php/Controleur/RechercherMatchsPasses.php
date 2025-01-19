<?php
namespace Controleur;

use DAO\MatchDAO;
class RechercherMatchsPasses
{

	// définition des attributs 
	private $matchDAO;
	private $dateMatch;

	/**
	 * Le constructeur initialise les propriétés de la classe avec les valeurs passées en argument.
	 *
	 * @param MatchDAO $matchDAO L'objet MatchDAO permettant d'effectuer des recherches sur la table des matchs
	 * @param string $dateMatch La date à partir de laquelle les matchs passés seront recherchés.
	 */
	public function __construct(MatchDAO $matchDAO, $dateMatch)
	{
		$this->matchDAO = $matchDAO;
		$this->dateMatch = $dateMatch;
	}

	/**
	 * Cette méthode exécute la recherche des matchs passés à partir de la date spécifiée.
	 *
	 * @return array Retourne un tableau d'objets Match correspondant aux matchs passés.
	 */
	public function executer(): array
	{
		$matchs = $this->matchDAO->findOldMatch();
		return $matchs;
	}
}
?>