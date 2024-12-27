<?php
class RechercherJouer {

    private $jouerDAO;
    private $n_licence;
    private $id_matchs;

    public function __construct(JouerDAO $jouerDAO, $n_licence, $id_matchs) {
        $this->jouerDAO = $jouerDAO;
        $this->n_licence = $n_licence;
        $this->id_matchs = $id_matchs;
    }

    public function executer(): Jouer {
        return $this->jouerDAO->findById($this->n_licence, $this->id_matchs);
    }
}
?>
