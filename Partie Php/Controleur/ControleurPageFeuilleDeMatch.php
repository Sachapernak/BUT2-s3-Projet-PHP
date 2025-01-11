<?php

namespace Controleur;

use DAO\JoueurDAO;
use DAO\MatchDAO;
use DAO\JouerDAO;
use Controleur\RechercherJoueursActifs;

class ControleurPageFeuilleDeMatch
{

    private $joueurDAO;
    private $jouerDAO;
    private $matchDAO;

    public function __construct()
    {
        $this->joueurDAO = new JoueurDAO();
        $this->jouerDAO = new JouerDAO();
        $this->matchDAO = new MatchDAO();
    }

    public function getJoueursActifs(): array{
        $recherche = new RechercherJoueursActifs($this->joueurDAO, 'act');
        return $recherche->executer();

    }


}

?>