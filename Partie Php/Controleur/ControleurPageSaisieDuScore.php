<?php

namespace Controleur;

use DAO\MatchDAO;
use Controleur\ModifierMatch;
use Controleur\RechercherUnMatch;

class ControleurPageSaisieDuScore {

    private $matchDAO;

    public function __construct()
    {
        $this->matchDAO = new MatchDAO();
    }

    public function saisirScore($id_match)
    {
        $score = $_POST['resultat'];

        $match = $this->recupererInfosMatch($id_match);
        
        $match->setResultat($score);

        $misAJour = new ModifierMatch($this->matchDAO, $match); 
        $misAJour->executer();

        header('Location: Matchs.php');
        exit;

    }

    public function recupererInfosMatch($idMatch){
        $recherche = new RechercherUnMatch($this->matchDAO, $idMatch);
        $match = $recherche->executer();

        return $match;
    }

    public function afficherLieu($lieu){
        $resultat = "";
        switch ($lieu) {
            case "ext":
                $resultat = "Extérieur";
                break;
            case "dom":
                $resultat = "A domicile";
                break;
            default: 
                $resultat = "Erreur";
                break;
        }
        return $resultat;
    }


}

?>