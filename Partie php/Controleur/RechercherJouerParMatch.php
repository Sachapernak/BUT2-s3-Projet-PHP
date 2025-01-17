<?php
namespace Controleur;
use DAO\JouerDAO;

class RechercherJouerParMatch {

    // Définition des attributs
    private $jouerDAO;
    private $id_match;

    /**
     * Le constructeur initialise les propriétés de la classe avec les valeurs passées en argument.
     *
     * @param JouerDAO $jouerDAO L'objet JouerDAO permettant d'effectuer des recherches sur la table 'Jouer'
     * @param int $id_match L'identifiant du match pour lequel on veut récupérer les joueurs
     */
    public function __construct(JouerDAO $jouerDAO, $id_match) {
        $this->jouerDAO = $jouerDAO;
        $this->id_match = $id_match;
    }

    /**
     * Cette méthode permet de récupérer tous les enregistrements 'Jouer' associés à un match donné, en se basant sur l'ID du match.
     * Elle appelle la méthode 'findByIdMatch' du JouerDAO pour effectuer la recherche.
     *
     * @return array Retourne un tableau d'objets 'Jouer' correspondant au match avec l'ID donné.
     */
    public function executer(): array {
        return $this->jouerDAO->findByIdMatch($this->id_match); 
    }
}
?>
