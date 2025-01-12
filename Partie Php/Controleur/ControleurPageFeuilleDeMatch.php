<?php

namespace Controleur;

use DateTime;

use DAO\JoueurDAO;
use DAO\MatchDAO;
use DAO\JouerDAO;
use Modele\MatchBasket;
use Controleur\RechercherJoueursActifs;
use Controleur\RechercherJouerParMatch;

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

    public function creerUnMatch() {
        $date_match = $_POST['date'];
        $heure_match = $_POST['heure'];

        $dateTimeString = $date_match . ' ' . $heure_match; 
        $dateTime = new DateTime($dateTimeString);

        $adversaire = $_POST['adversaire'];
        $lieu = $_POST['lieu'];

        $match = new MatchBasket($dateTime, $adversaire, $lieu);


        /* ajouter jouer*/

        $creationMatch = new CreerUnMatch($this->matchDAO, $match);
        $creationMatch->executer();
     
        header('Location: Matchs.php');
    }

    public function verifierPosition($id_match) {
        $recherche = new RechercherJouerParMatch($this->matchDAO, $id_match);
        $res = $recherche->executer();


    }

    public function ajouterJouer(){
        
    }


}

?>