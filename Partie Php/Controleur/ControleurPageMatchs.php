<?php

namespace Controleur;

use DAO\JoueurDAO;
use DAO\MatchDAO;
use DAO\JouerDAO;
use Controleur\RechercherJouerParMatch;
use Controleur\RechercherMatchsAVenir;
use Controleur\SupprimerUnMatch;

class ControleurPageMatchs
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

    public function getJoueursParticipants($id_match)
    {
        $resultat = [];
        $recherche = new RechercherJouerParMatch($this->jouerDAO, $id_match);
        $listeMatchsJoues = $recherche->executer();
        foreach ($listeMatchsJoues as $jouer) {
            $n_licence = $jouer->getN_licence();
            $recherche = new RechercherUnJoueur($this->joueurDAO, $n_licence);
            $joueur = $recherche->executer();

            $resultat[] = $joueur;
        }

        return $resultat;
    }

    public function getInfosParticipants($id_match, $id_joueur)
    {
        $recherche = new RechercherJouer($this->jouerDAO, $id_joueur, $id_match);
        $resultat = $recherche->executer();
        return $resultat;

    }

    public function getMatchsAVenir()
    {
        $recherche = new RechercherMatchsAVenir($this->matchDAO, date('Y-m-d'));
        $res = $recherche->executer();
        return $res;
    }

    public function getMatchsPasses()
    {
        $recherche = new RechercherMatchsPasses($this->matchDAO, date('Y-m-d'));
        $res = $recherche->executer();
        return $res;
    }

    public function afficherEtoiles($note): string
    {
        $etoile = "";
        $nbrEtoilesTotal = 5;
        for ($i = 0; $i < $note; $i++) {
            $etoile .= "★";
        }
        $etoilesVides = $nbrEtoilesTotal - $note;
        for ($i = 0; $i < $etoilesVides; $i++) {
            $etoile .= "☆";
        }

        return $etoile;
    }

    

    public function afficherRemplacement($estRemplacant)
    {
        $resultat = "";
        switch ($estRemplacant) {
            case 1:
                $resultat = "Remplacant";
                break;
            case 0:
                $resultat = "Titulaire";
                break;
        }
        return $resultat;
    }

    public function supprimerMatch($idMatch)
    {
        $suppression = new SupprimerUnMatch($this->matchDAO, $idMatch);
        $suppression->executer();
    }

}

?>