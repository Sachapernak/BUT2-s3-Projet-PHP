<?php

namespace Controleur;

use DAO\JoueurDAO;
use Modele\Joueur;

class RechercherJoueursActifs
{


	private $joueurDAO;
	private $statut;

	/**
	 * Le constructeur initialise les propriétés de la classe avec les valeurs passées en argument.
	 *
	 * @param JoueurDAO $joueurDAO L'objet JoueurDAO permettant d'effectuer des recherches sur la table des joueurs
	 * @param string $statut Le statut des joueurs à rechercher (par exemple, 'actif')
	 */
	public function __construct(JoueurDAO $joueurDAO, $statut)
	{
		$this->joueurDAO = $joueurDAO;
		$this->statut = $statut;
	}

	 /**
     * Cette méthode permet de récupérer tous les joueurs ayant un statut spécifique, par exemple 'actif'.
     * Elle appelle la méthode 'findByStatut' de l'objet JoueurDAO pour effectuer la recherche.
     *
     * @return array Retourne un tableau d'objets Joueur correspondant au statut demandé.
     */
	public function executer(): array
	{
		return $this->joueurDAO->findByStatut($this->statut);
	}
}
?>