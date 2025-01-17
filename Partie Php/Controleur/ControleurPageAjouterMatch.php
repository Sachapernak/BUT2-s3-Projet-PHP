<?php

namespace Controleur;

use DateTime;

use DAO\MatchDAO;
use Modele\MatchBasket;



class ControleurPageAjouterMatch
{
    private $matchDAO;

    public function __construct()
    {
         $this->matchDAO = new MatchDAO();
    }



    public function creerUnMatch() {
        $date_match = $_POST['date'];
        $heure_match = $_POST['heure'];

        $dateTimeString = $date_match . ' ' . $heure_match; 
        $dateTime = new DateTime($dateTimeString);
        $dateTimeFormatted = $dateTime->format('Y-m-d H:i:s');

        $adversaire = $_POST['adversaire'];
        $lieu = $_POST['lieu'];

        $match = new MatchBasket($dateTimeFormatted, $adversaire,$lieu);


        /* ajouter jouer*/

        $creationMatch = new CreerUnMatch($this->matchDAO, $match);
        $idMatch = $creationMatch->executer();
        header('Location: Matchs.php');
        return $idMatch;
     

    }

}

?>