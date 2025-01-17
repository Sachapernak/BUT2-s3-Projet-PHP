<?php

namespace Controleur;
use DAO\JouerDAO;
use Modele\Jouer;
class RechercherJouer {

    private $jouerDAO;
    private $n_licence;
    private $id_match;

    public function __construct(JouerDAO $jouerDAO, $n_licence, $id_match) {
        $this->jouerDAO = $jouerDAO;
        $this->n_licence = $n_licence;
        $this->id_match = $id_match;
    }

    public function executer(): Jouer|null {
        return $this->jouerDAO->findById($this->n_licence, $this->id_match);
    }
}
?>
