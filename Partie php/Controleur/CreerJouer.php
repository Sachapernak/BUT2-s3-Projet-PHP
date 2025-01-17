<?php

namespace Controleur;

use DAO\JouerDAO;
use Modele\Jouer;

class CreerJouer {

    private $jouerDAO;
    private $n_licence;
    private $id_match;
    private $est_remplacant;
    private $note;
    private $role;

    public function __construct(JouerDAO $jouerDAO, Jouer $jouer) {
        $this->jouerDAO = $jouerDAO;
        $this->n_licence = $jouer->getN_licence();
        $this->id_match = $jouer->getId_match();
        $this->est_remplacant = $jouer->getEst_remplacant();
        $this->note = $jouer->getNote();
        $this->role = $jouer->getRole();
    }

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
