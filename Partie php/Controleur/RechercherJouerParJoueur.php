<?php

namespace Controleur;

use DAO\JouerDAO;

class RechercherJouerParJoueur {

    // Définition des attributs
    private $jouerDAO;
    private $n_licence;

    /**
     * Le constructeur initialise les propriétés de la classe avec les valeurs passées en argument.
     *
     * @param JouerDAO $jouerDAO L'objet JouerDAO qui permet d'effectuer des opérations sur la table 'Jouer' de la base de données.
     * @param int $n_licence Le numéro de licence du joueur pour lequel nous voulons effectuer la recherche.
     */
    public function __construct(JouerDAO $jouerDAO, $n_licence) {
        $this->jouerDAO = $jouerDAO;
        $this->n_licence = $n_licence;
    }

    /**
     * Cette méthode permet de récupérer tous les enregistrements 'Jouer' d'un joueur donné, en se basant sur son numéro de licence.
     * Elle appelle la méthode 'findByIdJoueur' du DAO pour effectuer cette recherche.
     *
     * @return array Retourne un tableau d'objets 'Jouer' correspondant au joueur avec le numéro de licence donné.
     */
    public function executer(): array {
        return $this->jouerDAO->findByIdJoueur($this->n_licence);
    }
}
?>
