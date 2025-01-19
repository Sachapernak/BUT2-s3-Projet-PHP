<?php

namespace Controleur;

use DAO\MatchDAO;
use Modele\MatchBasket;
class RechercherUnMatch
{

	// définition des attributs 
	private $matchDAO;
	private $id_match;

	/**
	 * Constructeur de la classe. Initialise les attributs avec les valeurs passées en paramètre.
	 * 
	 * @param MatchDAO $matchDAO Instance de MatchDAO pour effectuer des requêtes sur les matchs
	 * @param string $id_match Identifiant du match à rechercher
	 */
	public function __construct(MatchDAO $matchDAO, $id_match)
	{
		$this->matchDAO = $matchDAO;
		$this->id_match = $id_match;
	}

	 /**
     * Exécute la recherche d'un match spécifique en fonction de l'identifiant du match.
     * 
     * @return MatchBasket|null Le match correspondant à l'identifiant donné, ou null si aucun match n'est trouvé
     */
	public function executer(): ?MatchBasket
	{
		return $this->matchDAO->findById($this->id_match);
	}
}
?>