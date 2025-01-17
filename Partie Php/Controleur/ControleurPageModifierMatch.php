<?php

namespace Controleur;

use DateTime;

use DAO\MatchDAO;



class ControleurPageModifierMatch
{

    private $matchDAO;

    public function __construct()
    {
         $this->matchDAO = new MatchDAO();
    }



    public function modifierMatch($idMatch)
    {
        $date_match = $_POST['date'];
        $heure_match = $_POST['heure'];

        $dateTimeString = $date_match . ' ' . $heure_match; 
        $dateTime = new DateTime($dateTimeString);
        $dateTimeFormatted = $dateTime->format('Y-m-d H:i:s');

        $adversaire = $_POST['adversaire'];
        $lieu = $_POST['lieu'];

        $recherche = new RechercherUnMatch($this->matchDAO, $idMatch);
        $match = $recherche->executer();
        $match->setDate_et_heure($dateTimeFormatted);
        $match->setAdversaire($adversaire);
        $match->setLieu($lieu);

        $modifiermatch = new ModifierMatch($this->matchDAO, $match);
        $modifiermatch->executer();

        header('Location: Matchs.php');

        return $this->matchDAO->findById($idMatch);
    }

    public function recupererInfosMatch($idMatch){
        $recherche = new RechercherUnMatch($this->matchDAO, $idMatch);
        $match = $recherche->executer();

        return $match;
    }

}

?>