<?php

namespace Controleur;


use DAO\JouerDAO;
use DAO\JoueurDAO;
use Controleur\RechercherJouer;
use Controleur\RechercherUnJoueur;
use Controleur\ModifierJouer;




class ControleurPageSaisieNote
{

    private $jouerDAO;
    private $joueurDAO;

    public function __construct()
    {
         $this->jouerDAO = new JouerDAO();
         $this->joueurDAO = new JoueurDAO();
    }



    public function modifierJouer($idMatch, $n_licence)
    {
        $note = $_POST["note"];

        $recherche = new RechercherJouer($this->jouerDAO, $n_licence,$idMatch);
        $jouer = $recherche->executer();

        $jouer->setNote($note);

        $modifierJouer = new ModifierAttributsJouer($this->jouerDAO, $jouer);
        $modifierJouer->executer();

        header('Location: Matchs.php');

        return $this->jouerDAO->findById($n_licence,$idMatch);
    }

    public function recupererInfosJouer($idMatch, $n_licence){
        $recherche = new RechercherJouer($this->jouerDAO, $n_licence ,$idMatch);
        $jouer = $recherche->executer();

        return $jouer;
    }

    public function recupererInfosJoueur($n_licence){
        $recherche = new RechercherUnJoueur($this->joueurDAO, $n_licence);	
        $joueur = $recherche->executer();

        return $joueur;
    }


}

?>