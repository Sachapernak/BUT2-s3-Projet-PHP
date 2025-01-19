<?php
namespace Controleur;

use DAO\JouerDAO;
class SupprimerJouer
{

    private $jouerDAO;
    private $n_licence;
    private $id_match;

    /**
     * Constructeur de la classe. Initialise les attributs avec les valeurs passées en paramètre.
     *
     * @param JouerDAO $jouerDAO Instance de JouerDAO pour effectuer des requêtes sur la base de données des matchs des joueurs
     * @param string $n_licence Numéro de licence du joueur concerné
     * @param int $id_match ID du match concerné
     */
    public function __construct(JouerDAO $jouerDAO, $n_licence, $id_match)
    {
        $this->jouerDAO = $jouerDAO;
        $this->n_licence = $n_licence;
        $this->id_match = $id_match;
    }

    /**
     * Exécute la suppression du joueur d'un match spécifique.
     *
     * @return bool Retourne true si la suppression a réussi, false sinon
     */
    public function executer(): bool
    {
        return $this->jouerDAO->deleteById($this->n_licence, $this->id_match);
    }
}
?>