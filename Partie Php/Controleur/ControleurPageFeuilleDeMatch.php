<?php

namespace Controleur;

use DateTime;

use DAO\JoueurDAO;
use DAO\MatchDAO;
use DAO\JouerDAO;
use Modele\MatchBasket;
use Modele\Jouer;
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
        $idMatch = $creationMatch->executer();

        return $idMatch;
     

    }

    public function creerParticipation(array $joueursSelectionnes, $idMatch) {
        foreach ($joueursSelectionnes as $joueurSelect) {
            $n_licence = $joueurSelect['n_licence'];
            $position = $joueurSelect['position'];
            $estRemplacant = $joueurSelect['role'];

            $jouer = new Jouer($n_licence,$idMatch,$estRemplacant);
    
            $creationMatch = new CreerJouer($this->jouerDAO, $jouer);
            $creationMatch->executer();
        }

        

       
     
        header('Location: Matchs.php');
    }

    public function verifierPosition(array $joueursSelectionnes): bool {
        $positionMeneur = 'Meneur';
        $positionAilier = 'Ailier';
        $positionPivot = 'Pivot';
        $countMeneur = 0;
        $countAilier = 0;
        $countPivot = 0;

        foreach ($joueursSelectionnes as $jouer) {
            if ($jouer['position'] === $positionMeneur) {
                $countMeneur++;
            }
            if ($jouer['position'] === $positionAilier) {
                $countAilier++;
            }
            if ($jouer['position'] === $positionPivot) {
                $countPivot++;
            }
        }
        return $countMeneur >= 1 && $countAilier >= 2 && $countPivot >=2;
    }

    public function verifierTailleJoueursSelec(array $joueursSelectionnes): bool{
        return count($joueursSelectionnes) > 5;
    }


}

?>