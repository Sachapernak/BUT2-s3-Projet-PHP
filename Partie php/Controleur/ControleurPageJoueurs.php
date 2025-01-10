<?php

namespace Controleur;

use DAO\JoueurDAO;
use DAO\JouerDAO;

use Controleur\ObtenirTousLesJoueurs;
use Controleur\RechercherParAttributsJoueurs;
use Controleur\ObtenirMoyenneNoteJoueur;

class ControleurPageJoueurs
{

    private $joueurDAO;
    private $jouerDAO;

    public function __construct(){
        $this->joueurDAO = new JoueurDAO();
        $this->jouerDAO = new JouerDAO();
    }

    public function getJoueurs() : array {
        $obtenirTousLesJoueurs = new ObtenirTousLesJoueurs($this->joueurDAO);
        return $obtenirTousLesJoueurs->executer();

    }

    public function getNoteMoyenneJoueur($n_licence): int{
        $obtenirMoyenneNoteJoueur = new ObtenirMoyenneNoteJoueur($this->jouerDAO, $n_licence);
        return $obtenirMoyenneNoteJoueur->executer();
    }

    public function afficherEtoiles($n_licence) : string {
        $etoile = ""; 
        $nbrEtoilesTotal = 5;
        $note = $this->getNoteMoyenneJoueur($n_licence);
        for ($i = 0; $i < $note; $i++) {
            $etoile.= "★";
        }
        $etoilesVides = $nbrEtoilesTotal - $note;
        for ($i = 0; $i < $etoilesVides; $i++) {
            $etoile.= "☆";
        }

        return $etoile;
    }

    public function resultatRecherche($recherche): array{
        $rechercherJoueurs = new RechercherParAttributsJoueurs($this->joueurDAO, $recherche);
        return $rechercherJoueurs->executer();
    }
}

?>