<?php
namespace Controleur;

use DAO\JouerDAO;
class SupprimerJouer {

    private $jouerDAO;
    private $n_licence;
    private $id_match;

    public function __construct(JouerDAO $jouerDAO, $n_licence, $id_match) {
        $this->jouerDAO = $jouerDAO;
        $this->n_licence = $n_licence;
        $this->id_match = $id_match;
    }

    public function executer(): bool {
        return $this->jouerDAO->delete($this->n_licence, $this->id_match);
    }
}
?>
