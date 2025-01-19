<?php

namespace Controleur;

use DAO\JouerDAO;

class ObtenirMoyenneNoteJoueur
{

	// définition des attributs 
	private $jouerDAO;          // L'objet JouerDAO utilisé pour interagir avec la base de données des joueurs
	private $n_licence;         // Le numéro de licence du joueur pour lequel on souhaite obtenir la moyenne des notes

	/**
	 * Constructeur de la classe ObtenirMoyenneNoteJoueur.
	 * Ce constructeur initialise les propriétés avec l'objet JouerDAO et le numéro de licence du joueur.
	 *
	 * @param JouerDAO $jouerDAO L'objet JouerDAO permettant d'effectuer des opérations sur la base de données des joueurs
	 * @param string $n_licence Le numéro de licence du joueur dont on souhaite obtenir la moyenne des notes
	 */
	public function __construct(JouerDAO $jouerDAO, $n_licence)
	{
		$this->jouerDAO = $jouerDAO;
		$this->n_licence = $n_licence;
	}

	/**
     * Méthode pour exécuter l'obtention de la moyenne des notes du joueur.
     * Cette méthode appelle la méthode `moyenneNoteJoueur` de l'objet JouerDAO et arrondit la note moyenne.
     *
     * @return int La moyenne des notes du joueur, arrondie à l'entier le plus proche
     */
	public function executer(): int
	{
		$moyenne = round($this->jouerDAO->moyenneNoteJoueur($this->n_licence));

        if ($moyenne == null || $moyenne < 0 || $moyenne > 5 ) {
            return 0;
        }
        return $moyenne;

    }
}
?>