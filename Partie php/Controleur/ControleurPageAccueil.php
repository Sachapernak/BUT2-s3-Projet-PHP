<?php

namespace Controleur;

use DAO\DaoEntraineur;
use DAO\MatchDAO;
use DAO\CommentaireDAO;
use DAO\JouerDAO;
use DAO\JoueurDAO;
use Controleur\RechercherMatchsPasses;
use Controleur\RechercherUnJoueur;
use Controleur\RechercherJouer;
use Controleur\RechercherUnCommentaire;


class ControleurPageAccueil
{
    private $matchDAO;
    private $jouerDAO;
    private $joueurDAO;
    private $commentaireDAO;

    public function __construct(){
        $this->matchDAO = new MatchDAO();
        $this->jouerDAO = new JouerDAO();
        $this->joueurDAO = new JoueurDAO();
        $this->commentaireDAO = new CommentaireDAO();
    }

    public function infoPageAccueil($idManager) : string {
        $dao = new DaoEntraineur();

        $entraineur = $dao ->getById($idManager);

        if ($entraineur == null){
            $res = "";
        } else {
            $res =  $entraineur->getPrenom() ." ". $entraineur->getNom() ;
        }
        return $res;
    }

    public function getMatchsRecents (){
        $recherche = new RechercherMatchsPasses($this->matchDAO, date('Y-m-d'));
        $res = $recherche->executer();
        return array_slice($res, 0, 2);   
    }

    public function getMeilleurJoueur ($idMatch){
        $n_licence = $this->jouerDAO->getMeilleurJoueurMatch($idMatch);
        $recherche = new RechercherUnJoueur($this->joueurDAO, $n_licence);
        $res = $recherche->executer();
        return $res;  
    }

    public function getCommentaireJoueur ($n_licence, $dateMatch) {
        $recherche = new RechercherUnCommentaire($this->commentaireDAO, $n_licence, $dateMatch);
        $res = $recherche->executer();
        if($res) {
            return $res->getCommentaire();
        }
        return "";
    }

    public function getParticipation ($n_licence, $id_match) {
        $recherche = new RechercherJouer($this->jouerDAO, $n_licence, $id_match);
        $res = $recherche->executer();
        return $res;
    }

    public function afficherResultat ($resultat): string {
        switch ($resultat) {
            case 'N':
                return 'Match nul';
            case 'V':
                return 'Victoire';
            case 'D':
                return 'Défaite';
            default:
                return '';
        }
    }

    public function afficherLieu($lieu): string{
        switch ($lieu) {
            case 'ext':
                return 'à l\'extérieur';
            case 'dom':
                return 'à domicile';
            default: 
                return '';
        }
    }

    public function getJoueursActifs(){
        $res = $this->joueurDAO->findByStatut('Act'); 
        return $res;
    }
}