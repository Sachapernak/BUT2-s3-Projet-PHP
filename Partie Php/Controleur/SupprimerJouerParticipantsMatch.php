<?php
namespace Controleur;

use DAO\JouerDAO;
class SupprimerJouerParticipantsMatch {

    private $jouerDAO;
    private $id_match;

    /**
     * Constructeur de la classe. Initialise les attributs avec les valeurs passées en paramètre.
     *
     * @param JouerDAO $jouerDAO Instance de JouerDAO pour effectuer des requêtes sur la base de données des joueurs ayant participé aux matchs
     * @param int $id_match ID du match dont on veut supprimer tous les participants
     */
    public function __construct(JouerDAO $jouerDAO, $id_match) {
        $this->jouerDAO = $jouerDAO;
        $this->id_match = $id_match;
    }

    /**
     * Exécute la suppression de tous les joueurs ayant participé au match spécifié.
     *
     * @return bool Retourne true si la suppression des joueurs a réussi, false sinon
     */
    public function executer(): bool {
        return $this->jouerDAO->deleteByMatch( $this->id_match);
    }
}
?>
