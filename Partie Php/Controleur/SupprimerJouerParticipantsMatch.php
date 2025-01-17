<?php
namespace Controleur;

use DAO\JouerDAO;
class SupprimerJouerParticipantsMatch {

    private $jouerDAO;
    private $id_match;

    public function __construct(JouerDAO $jouerDAO, $id_match) {
        $this->jouerDAO = $jouerDAO;
        $this->id_match = $id_match;
    }

    public function executer(): bool {
        return $this->jouerDAO->deleteByMatch( $this->id_match);
    }
}
?>
