<?php
    namespace Controleur;
    use DAO\JouerDAO;
class ObtenirTousLesJouer {

    private $jouerDAO;

    public function __construct(JouerDAO $jouerDAO) {
        $this->jouerDAO = $jouerDAO;
    }

    public function executer(): array {
        return $this->jouerDAO->findAll();
    }
}
?>
