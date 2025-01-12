<?php

namespace Controleur;

use DAO\JoueurDAO;
use DAO\MatchDAO;
use DAO\JouerDAO;

use Modele\Joueur;



class ControleurPageStatistiques
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

    public function getTotalVictoires(): int
    {
        $total = $this->matchDAO->getTotalVictoires();
        return $total;
    }

    public function getTotalDefaites(): int
    {
        $total = $this->matchDAO->getTotalDefaites();
        return $total;
    }

    public function getTotalNuls(): int
    {
        $total = $this->matchDAO->getTotalNuls();
        return $total;
    }

    public function getPourcentVictoires(): float
    {
        $nbVictoires = $this->getTotalVictoires();
        $nbMatchs = $this->matchDAO->getTotalMatchs();
        if ($nbMatchs == 0) {
            return 0.0;
        }

        $pourcentageVictoires = ($nbVictoires / $nbMatchs) * 100;

        return $pourcentageVictoires;

    }

    public function getPourcentDefaites(): float
    {
        $nbDefaites = $this->getTotalDefaites();
        $nbMatchs = $this->matchDAO->getTotalMatchs();
        if ($nbMatchs == 0) {
            return 0.0;
        }

        $pourcentageDefaites = ($nbDefaites / $nbMatchs) * 100;

        return $pourcentageDefaites;

    }

    public function getPourcentNuls(): float
    {
        $nbNuls = $this->getTotalNuls();
        $nbMatchs = $this->matchDAO->getTotalMatchs();
        if ($nbMatchs == 0) {
            return 0.0;
        }

        $pourcentageNuls = ($nbNuls / $nbMatchs) * 100;

        return $pourcentageNuls;
    }

    public function getPosteFavoris(Joueur $joueur): string{
        $n_licence = $joueur->getN_licence();
        $posteFav = $this->jouerDAO->getPositionFavoriteJoueur($n_licence);
        return $posteFav;
    }

    public function getTitularisations(Joueur $joueur): int{
        $n_licence = $joueur->getN_licence();
        $titularisation = $this->jouerDAO->getTitularisationsJoueur($n_licence);
        return $titularisation;
    }

    public function getRemplacements(Joueur $joueur): int{
        $n_licence = $joueur->getN_licence();
        $titularisation = $this->jouerDAO->getRemplacementsJoueur($n_licence);
        return $titularisation;
    }

    public function getMoyenneEval(Joueur $joueur) {
        $n_licence = $joueur->getN_licence();
        $moyenne = $this->jouerDAO->moyenneNoteJoueur($n_licence);
        return $moyenne;
    }

    public function getMatchsConsecutifs(Joueur $joueur): int{
        $n_licence = $joueur->getN_licence();
        $titularisation = $this->jouerDAO->getNbMatchsConsecutifsJoueur($n_licence);
        return $titularisation;
    }




}

?>