<?php

namespace Controleur;

use DAO\JouerDAO;
use Modele\Jouer;

class CreerJouer {

    private $jouerDAO;  // Objet JouerDAO pour interagir avec la base de données concernant les participations des joueurs.
    private $n_licence; // Numéro de licence du joueur.
    private $id_match;  // ID du match auquel le joueur participe.
    private $est_remplacant; // Indique si le joueur est un remplaçant.
    private $note; // Note attribuée au joueur pour sa performance dans le match.
    private $role; // Le rôle ou la position du joueur dans le match.

     /**
     * Constructeur de la classe CreerJouer.
     * Il initialise les propriétés de l'objet à partir de l'objet Jouer passé en paramètre.
     *
     * @param JouerDAO $jouerDAO Objet JouerDAO utilisé pour interagir avec la base de données.
     * @param Jouer $jouer Objet Jouer contenant les informations à insérer.
     */
    public function __construct(JouerDAO $jouerDAO, Jouer $jouer) {
        $this->jouerDAO = $jouerDAO;
        $this->n_licence = $jouer->getN_licence();
        $this->id_match = $jouer->getId_match();
        $this->est_remplacant = $jouer->getEst_remplacant();
        $this->note = $jouer->getNote();
        $this->role = $jouer->getRole();
    }

      /**
     * Méthode exécutant l'insertion des données du joueur dans la base de données.
     * Elle appelle la méthode d'insertion du JouerDAO avec les données nécessaires.
     */
    public function executer() {
        $this->jouerDAO->insert(
            $this->n_licence,
            $this->id_match,
            $this->est_remplacant,
            $this->note,
            $this->role
        );
    }
}
?>
